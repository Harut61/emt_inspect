<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as SupportCollection;

class NsiQueue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nsi_queue';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public $timestamps = false;

    public function results()
    {
        return $this->hasMany(NsiResult::class, 'queue_id', 'id');
    }

    public function getResultsWithInterval(Carbon $from, Carbon $to, bool $secure)
    {
        /** @var SupportCollection $eloquentCollection */
        $resultsCollection = $this->whereBetween('status_date', [$from, $to])->get()
            ->map(function ($queue) use ($secure) {
                /** @var Collection $queue */
                return $queue->results;
            })->flatten();

        /** Filter results by product. Block if it has only one insecure result for required secure results.
         * Or pass if it don't have any insecure result for required insecure results.
         * 
         * @var SupportCollection $resultsCollection
         */
        $resultsCollection = $resultsCollection->groupBy('product_id')->filter(function ($results) use ($secure) {
            $insecureResults = $results->where('secure', 0);

            return $secure ? $insecureResults->count() == 0 : $insecureResults->count() > 0;
        })->flatten();

        $resultsCollection = $secure ? $resultsCollection : $resultsCollection->where('secure', 0);

        return $resultsCollection->unique('product_id');
    }

    public function getLastScanDateQueuesResults(bool $secure)
    {
        return $this->get()->groupBy(function ($queue) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $queue->status_date)->format('Y-m-d');
        })->last()->map(function ($queue) use ($secure) {
            /** @var Collection $queue */
            return $queue->results;
        })->map(function ($collection) use ($secure) {
            /** @var EloquentCollection $collection */
            return $collection->filter(function (NsiResult $result) use ($secure) {
                return $secure ? $result->secure != 0 : $result->secure == 0;
            });
        })->flatten()->unique('product_id');
    }

    public function getOnlyActiveResultsWithInterval(Carbon $from, Carbon $to, bool $secure)
    {
        return $this->whereBetween('status_date', [$from, $to])->get()
            ->map(function ($queue) use ($secure) {
                /** @var Collection $queue */
                return $queue->results;
            })->map(function ($collection) use ($secure) {
                /** @var EloquentCollection $collection */
                return $collection->filter(function (NsiResult $result) use ($secure) {
                    return $secure ? $result->secure != 0 : $result->secure == 0;
                });
            })->flatten()->unique('product_id');
    }

    public function getOnlyInsecureResultsWithIntervalByVendor(Carbon $from, Carbon $to, bool $microsoft)
    {
        return $this->whereBetween('status_date', [$from, $to])->get()
            ->map(function ($queue) use ($microsoft) {
                /** @var Collection $queue */
                return $queue->results;
            })->map(function ($collection) use ($microsoft) {
                /** @var EloquentCollection $collection */
                return $collection->filter(function (NsiResult $result) use ($microsoft) {
                    return $microsoft ? $result->secure == 0 && $result->OsSoft->vendor_id == 1 :
                        $result->secure == 0 && $result->OsSoft->vendor_id != 1;
                });
            })->flatten()->unique('product_id');
    }

    /**
     * Find new vulterabilities for product for some period for all vendors.
     * 
     * @param mixed $secure 
     * @param mixed $insecure 
     * @return SupportCollection 
     */
    public function getResultsForSameProductsByVendor(SupportCollection $secure, SupportCollection $insecure, bool $microsoft, string $type)
    {
        return $insecure->map(function ($insecureResult) use ($secure, $microsoft, $type) {
            /** @var NsiResult $insecureResult */

            $secureResultWithSameProduct = $secure->filter(function ($secureResult) use ($insecureResult, $microsoft) {
                return $microsoft ? $secureResult->OsSoft->vendor_id == 1 && $secureResult->product_id == $insecureResult->product_id :
                    $secureResult->OsSoft->vendor_id != 1 && $secureResult->product_id == $insecureResult->product_id;
            });

            if ($secureResultWithSameProduct->count() > 0) {
                $secureResultFiltered = $secureResultWithSameProduct->first();

                $secureDate = Carbon::createFromFormat('Y-m-d H:i:s', $secureResultFiltered->queue->status_date);
                $insecureDate = Carbon::createFromFormat('Y-m-d H:i:s', $insecureResult->queue->status_date);

                return $insecureDate->greaterThan($secureDate) ? $insecureResult : $secureResultFiltered;
            } else {
                switch ($type) {
                    case 'VIN':
                        return $insecureResult;
                        break;
                    case 'VOUT':
                        return false;
                        break;
                }
            }
        });
    }

    /**
     * Find fixed vulnerabilities for product for some period.
     * 
     * @param mixed $secure 
     * @param mixed $insecure 
     * @return SupportCollection 
     */
    public function getResultsForSameProducts(SupportCollection $secure, SupportCollection $insecure, string $type)
    {
        return $insecure->map(function ($insecureResult) use ($secure, $type) {
            /** @var NsiResult $result */

            $secureResultWithSameProduct = $secure->filter(function ($secureResult) use ($insecureResult) {
                return $secureResult->product_id == $insecureResult->product_id;
            });

            if ($secureResultWithSameProduct->count() > 0) {
                $secureResultFiltered = $secureResultWithSameProduct->first();

                $secureDate = Carbon::createFromFormat('Y-m-d H:i:s', $secureResultFiltered->queue->status_date);
                $insecureDate = Carbon::createFromFormat('Y-m-d H:i:s', $insecureResult->queue->status_date);

                return $insecureDate->greaterThan($secureDate) ? $insecureResult : $secureResultFiltered;
            } else {
                switch ($type) {
                    case 'VIN':
                        return $insecureResult;
                        break;
                    case 'VOUT':
                        return false;
                        break;
                }
            }
        });
    }

    public function getNetByVendor(bool $microsoft)
    {
        return $this->getLastScanDateQueuesResults(false)
            ->filter(function (NsiResult $result) use ($microsoft) {
                return $microsoft ? $result->OsSoft->vendor_id == 1 : $result->OsSoft->vendor_id != 1;
            });
    }
    
    /**
     * Get the date of the last scan
     * 
     * @return string
     */
    public static function getLastScanDate() 
    {
        return now()->subDay();
    }
    
    /**
     * Filter all results of a scan and group them by product
     * 
     * @param bool $secure
     * @return Eloquent collection
     */
    public static function getResultsGroupedByProduct(Carbon $date, bool $secure) 
    {
        return NsiQueue::whereBetween('status_date', [$date->copy()->subWeek()->startOfDay(), $date->copy()->endOfDay()])
            ->with(['results.vuln', 'results.vulnByProductid', 'results.vulnByKbArticle'])
            ->get() 
            ->map(function ($queue) use ($secure) {
                return $secure ? $queue->results->where('secure', '>', 0) : $queue->results->where('secure', 0);
            })->flatten()->unique('product_id')->map(function ($result) use ($date) {
                $checked = [];
                
                $result->installationCount = NsiQueue::whereBetween('status_date', [$date->copy()->subWeek()->startOfDay(), $date->copy()->endOfDay()])
                    ->with('results.queue')
                    ->get() 
                    ->map(function ($queue) use ($result) {
                        return $queue->results->where('secure', 0)->where('product_id', $result->product_id);
                    })->flatten()->filter(function ($result) use (&$checked) {
                        $check = $result->host . '_' . $result->path . '_' . $result->version;
                        $true = !in_array($check, $checked);
                        $checked[] = $check;
                        return $true;
                    })
                    ->count();
                    
                return $result;
            });
    }
}
