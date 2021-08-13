<?php

namespace App\Console\Commands;

use App\FlatReportingQuickLink;
use App\ServiceHealth;
use App\Traits\Vulnerabilities;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class FillFlatReportingQuickLinks extends Command
{
    use Vulnerabilities;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:reportingQuickLinks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fill flat_reporting_quick_links table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo 'run FillFlatReportingQuickLinks Cron job'. PHP_EOL;;

        $servicesHealth = ServiceHealth::all();
        //Convert string data to Carbon.
        $servicesHealth->map(function ($service) {
            $service->start_time = isset($service->start_time) ? Carbon::createFromFormat('Y-m-d H:i:s', $service->start_time) : null;
            $service->fail_time = isset($service->fail_time) ? Carbon::createFromFormat('Y-m-d H:i:s', $service->fail_time) : null;
        });

        $VIN = $this->getVINForFiveWeeks();
        $VOUT = $this->getVOUTForFiveWeeks();
        $NetNonMicrosoft = $this->getCurrentlyActiveVulnerabilitiesByVendor(false);
        $NetMicrosoft = $this->getCurrentlyActiveVulnerabilitiesByVendor(true);

        FlatReportingQuickLink::create([
            'services_health' => json_encode($servicesHealth),
            'vin' => json_encode($VIN),
            'vout' => json_encode($VOUT),
            'net_non_microsoft' => json_encode($NetNonMicrosoft),
            'net_microsoft' => json_encode($NetMicrosoft),
        ]);

        $flatReportingQuickLink = FlatReportingQuickLink::get();
        if(count($flatReportingQuickLink) > 1){
            FlatReportingQuickLink::first()->delete();
        }
    }
}
