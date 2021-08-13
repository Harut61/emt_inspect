<?php

namespace App\Traits;

use App\NsiQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection as SupportCollection;

trait Vulnerabilities
{
    /**
     * old version
     * Finds new vulnerabilities in last 5 weeks.
     *
     *  @return SupportCollection
     */
//    protected function getVINForFiveWeeks()
//    {
//        $queue = new NsiQueue();
//
//        /** @var EloquentCollection $allQueueDates */
//        $allQueuesDatesByPeriod = $queue->orderBy('status_date', 'desc')->get()->groupBy(function ($queue) {
//            return Carbon::createFromFormat('Y-m-d H:i:s', $queue->status_date)->format('Y-m-d');
//        })->take(6)->keys()->all();
//
//        sort($allQueuesDatesByPeriod);
//        array_pop($allQueuesDatesByPeriod);
//
//        $VINprevious5Weeks = collect([]);
//
//        foreach ($allQueuesDatesByPeriod as $date) {
//            $scantDate = Carbon::createFromFormat('Y-m-d', $date);
//
//            $VINprevious5Weeks->push($this->getVINForDate($scantDate));
//        }
//
//        /** @var SupportCollection $insecureResults */
//        $insecureResults = $queue->getLastScanDateQueuesResults(false);
//
//        return $queue->getResultsForSameProducts($VINprevious5Weeks->flatten(), $insecureResults, 'VIN');
//    }

    /**
     * old version
     * Finds fixed vulnerabilities in last 5 weeks.
     *
     *  @return SupportCollection
     */
//    protected function getVOUTForFiveWeeks()
//    {
//        $queue = new NsiQueue();
//
//        $latestScanDate = $queue->orderBy('status_date', 'desc')->get()->groupBy(function ($queue) {
//            return Carbon::createFromFormat('Y-m-d H:i:s', $queue->status_date)->format('Y-m-d');
//        })->take(6)->keys()->all();
//        $latestScanDate = Carbon::createFromFormat('Y-m-d', $latestScanDate[count($latestScanDate) - 1])->startOfDay();
//
//
//        $lastScanDate = $this->getLastScanDay()->copy();
//
//        $from = $lastScanDate->copy()->startOfDay();
//        $to = $lastScanDate = $this->getLastScanDay()->copy()->endOfDay();
//
//        /** @var SupportCollection $secureResults */
//        $secureResults = $queue->getResultsWithInterval($from, $to, true);
//
//        $from = $latestScanDate;
//        $to = $lastScanDate->copy()->subWeeks(1)->endOfDay();
//
//        /** @var SupportCollection $insecureResults */
//        $insecureResults = $queue->getResultsWithInterval($from, $to, false);
//
//        return $queue->getResultsForSameProducts($secureResults, $insecureResults, 'VOUT');
//    }

    /**
     * old version
     * Finds weekly net vulnerabilities by date.
     *
     *  @return SupportCollection  */
//    protected function getNetByDate(Carbon $date)
//    {
//        $queue = new NsiQueue();
//
//        $from = $date->copy()->subWeek()->startOfDay();
//        $to = $date->copy()->endOfDay();
//
//        return $queue->getOnlyActiveResultsWithInterval($from, $to, false)->filter(function ($result) {
//            return $result;
//        });
//    }

    /**
     * old version
     * @param bool $microsoft
     * @return type
     */
//    protected function getCurrentlyActiveVulnerabilitiesByVendor(bool $microsoft)
//    {
//        $lastScanDate = $this->getLastScanDay()->copy();
//
//        return $this->getNetForDateByVendor($lastScanDate, $microsoft);
//    }

    /**
     * old version
     * Finds VIN for week by specified scan date.
     *
     * @param Carbon $date
     * @return SupportCollection
     */
//    protected function getVINForDate(Carbon $date)
//    {
//        $queue = new NsiQueue();
//
//        $from = $date->copy()->subWeeks(1)->startOfDay();
//        $to = $from->copy()->endOfDay();
//
//        /** @var SupportCollection $secureResults */
//        $secureResults = $queue->getResultsWithInterval($from, $to, true);
//
//        $from = $date->copy()->startOfDay();
//        $to = $from->copy()->endOfDay();
//
//        /** @var SupportCollection $insecureResults */
//        $insecureResults = $queue->getResultsWithInterval($from, $to, false);
//
//        return $queue->getResultsForSameProducts($secureResults, $insecureResults, 'VIN')->filter(function ($result) {
//            return $result;
//        });
//    }

    /**
     * old version
     * Finds VOUT for week by specified scan date.
     *
     * @param Carbon $date
     * @return SupportCollection
     */
//    protected function getVOUTForDate(Carbon $date)
//    {
//        $queue = new NsiQueue();
//
//        $from = $date->copy()->subWeeks(1)->startOfDay();
//        $to = $from->copy()->endOfDay();
//
//        /** @var SupportCollection $insecureResults */
//        $insecureResults = $queue->getResultsWithInterval($from, $to, false);
//
//        $from = $date->copy()->startOfDay();
//        $to = $from->copy()->endOfDay();
//
//        /** @var SupportCollection $secureResults */
//        $secureResults = $queue->getResultsWithInterval($from, $to, true);
//
//        return $queue->getResultsForSameProducts($secureResults, $insecureResults, 'VOUT')->filter(function ($result) {
//            return $result;
//        });
//    }

    /**
     * old version
     * Finds VIN for week by specified scan date and by vendor.
     *
     * @param Carbon $date
     * @return SupportCollection
     */
//    protected function getVINForDateByVendor(Carbon $date, bool $microsoft)
//    {
//        $queue = new NsiQueue();
//
//        $from = $date->copy()->subWeeks(2)->startOfDay();
//        $to = $date->copy()->subWeeks(1)->endOfDay();
//
//        /** @var SupportCollection $secureResults */
//        $secureResults = $queue->getResultsWithInterval($from, $to, true);
//
//        $from = $date->copy()->subWeeks(1)->startOfDay();
//        $to = $date->copy()->endOfDay();
//
//        /** @var SupportCollection $insecureResults */
//        $insecureResults = $queue->getResultsWithInterval($from, $to, false);
//
//        return $queue->getResultsForSameProductsByVendor($secureResults, $insecureResults, $microsoft, 'VIN')->filter(function ($result) {
//            return $result;
//        });
//    }

    /**
     * old version
     * Finds VOUT for week by specified scan date and vendor.
     *
     * @param Carbon $date
     * @return SupportCollection
     */
//    protected function getVOUTForDateByVendor(Carbon $date, bool $microsoft)
//    {
//        $queue = new NsiQueue();
//
//        $from = $date->copy()->subWeeks(2)->startOfDay();
//        $to = $date->copy()->subWeeks(1)->endOfDay();
//
//        /** @var SupportCollection $insecureResults */
//        $insecureResults = $queue->getResultsWithInterval($from, $to, false);
//
//        $from = $date->copy()->subWeeks(1)->startOfDay();
//        $to = $date->copy()->endOfDay();
//
//        /** @var SupportCollection $secureResults */
//        $secureResults = $queue->getResultsWithInterval($from, $to, true);
//
//        return $queue->getResultsForSameProductsByVendor($secureResults, $insecureResults, $microsoft, 'VOUT')->filter(function ($result) {
//            return $result;
//        });
//    }

    /**
     * old version
     * @param Carbon $date
     * @param bool $microsoft
     * @return type
     */
//    protected function getNetForDateByVendor(Carbon $date, bool $microsoft)
//    {
//        $queue = new NsiQueue();
//
//        $from = $date->copy()->subWeek()->startOfDay();
//        $to = $date->copy()->endOfDay();
//
//        return $queue->getOnlyInsecureResultsWithIntervalByVendor($from, $to, $microsoft)->filter(function ($result) {
//            return $result;
//        });
//    }

    /**
     * old version
     * Gets day of last scans.
     *
     *  @return Carbon  */
//    protected function getLastScanDay(): Carbon
//    {
//        $queue = new NsiQueue();
//        $date = $queue->get()->groupBy(function ($queue) {
//            return Carbon::createFromFormat('Y-m-d H:i:s', $queue->status_date)->format('Y-m-d');
//        })->keys()->last();
//
//        return Carbon::createFromFormat('Y-m-d', $date)->startOfDay();
//    }

    /**
     * Finds VIN for week by specified scan date.
     *
     * @param Carbon $date
     * @return SupportCollection
     */
    protected function getVINForDate(Carbon $date)
    {
        // get insecure for current week
        $net = $this->getNetByDate($date);

        // get insecure for previous week
        $netPreviousWeek = $this->getNetByDate($date->copy()->subWeek())->pluck('product_id')->toArray();

        // remove from current week insecure, results that were insecure in previous week as well
        return $net->reject(function ($result) use ($netPreviousWeek) {
            return in_array($result->product_id, $netPreviousWeek);
        });
    }

    /**
     * Finds VOUT for week by specified scan date.
     *
     * @param Carbon $date
     * @return SupportCollection
     */
    protected function getVOUTForDate(Carbon $date)
    {
        // get insecure for previous week
        $netPreviousWeek = $this->getNetByDate($date->copy()->subWeek());

        // get insecure for current week
        $netCurrentWeek = $this->getNetByDate($date)->pluck('product_id')->toArray();

        // get secure for current week
        $secureCurrentWeek = NsiQueue::getResultsGroupedByProduct($date, true);

        return $netPreviousWeek->reject(function ($result) use ($netCurrentWeek) {
            // remove from previous week insecure, results that are insecure in this week as well
            return in_array($result->product_id, $netCurrentWeek);
        })->map(function ($result) use ($secureCurrentWeek) {
            // check if product is confirmed to be secure in current week
            $secureResulsts = $secureCurrentWeek->filter(function ($secure) use ($result) {
                return $secure->product_id === $result->product_id;
            });

            // if product is secure in current week than take the secure attribute
            // if not then set it to null
            $result->secure = $secureResulsts->isEmpty() ? null : $secureResulsts->first()->secure;

            return $result;
        });
    }

    /**
     * Finds weekly net vulnerabilities by date.
     *
     *  @return SupportCollection  */
    protected function getNetByDate(Carbon $date)
    {
        return NsiQueue::getResultsGroupedByProduct($date, false);
    }

    /**
     * Finds new vulnerabilities in last 5 weeks.
     *
     *  @return SupportCollection
     */
    protected function getVINForFiveWeeks()
    {
        $scanDate = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            NsiQueue::getLastScanDate()
        );

        $netCurrentWeek = $this->getNetByDate($scanDate)->pluck('product_id')->toArray();

        $VINForFiveWeeks = collect([]);

        for ($i = 0; $i < 5; $i++) {
            $VINForFiveWeeks->push($this->getVINForDate($scanDate));

            $scanDate->subWeek();
        }

        return $VINForFiveWeeks->flatten()->unique('product_id')->filter(function ($result) use ($netCurrentWeek) {
            return in_array($result->product_id, $netCurrentWeek);
        });
    }

    /**
     * Finds fixed vulnerabilities in last 5 weeks.
     *
     *  @return SupportCollection
     */
    protected function getVOUTForFiveWeeks()
    {
        $scanDate = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            NsiQueue::getLastScanDate()
        );

        $netCurrentWeek = $this->getNetByDate($scanDate)->pluck('product_id')->toArray();

        $VOUTForFiveWeeks = collect([]);

        for ($i = 0; $i < 5; $i++) {
            $VOUTForFiveWeeks->push($this->getVOUTForDate($scanDate));

            $scanDate->subWeek();
        }

        return $VOUTForFiveWeeks->flatten()->unique('product_id')->reject(function ($result) use ($netCurrentWeek) {
            return in_array($result->product_id, $netCurrentWeek);
        });
    }

    /**
     * old version
     * @param bool $microsoft
     * @return type
     */
    protected function getCurrentlyActiveVulnerabilitiesByVendor(bool $microsoft)
    {
        $lastScanDate = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            NsiQueue::getLastScanDate()
        );

        return $this->getNetForDateByVendor($lastScanDate, $microsoft);
    }

    /**
     * Finds VIN for week by specified scan date and by vendor.
     *
     * @param Carbon $date
     * @return SupportCollection
     */
    protected function getVINForDateByVendor(Carbon $date, bool $microsoft)
    {
        return $this->getVINForDate($date)->filter(function ($result) use ($microsoft) {
            if(isset($result->OsSoft->vendor_id)){
                return $microsoft ? $result->OsSoft->vendor_id === 1 : $result->OsSoft->vendor_id !== 1;
            }
        });
    }

    /**
     * Finds VOUT for week by specified scan date and vendor.
     *
     * @param Carbon $date
     * @return SupportCollection
     */
    protected function getVOUTForDateByVendor(Carbon $date, bool $microsoft)
    {
        return $this->getVOUTForDate($date)->filter(function ($result) use ($microsoft) {
            if(isset($result->OsSoft->vendor_id)){
                return $microsoft ? $result->OsSoft->vendor_id === 1 : $result->OsSoft->vendor_id !== 1;
            }
        });
    }

    /**
     * Finds Net for week by specified scan date and vendor.
     *
     * @param Carbon $date
     * @param bool $microsoft
     * @return type
     */
    protected function getNetForDateByVendor(Carbon $date, bool $microsoft)
    {
        return $this->getNetByDate($date)->filter(function ($result) use ($microsoft) {
            if(isset($result->OsSoft->vendor_id)){
                return $microsoft ? $result->OsSoft->vendor_id === 1 : $result->OsSoft->vendor_id !== 1;
            }
        });
    }
}
