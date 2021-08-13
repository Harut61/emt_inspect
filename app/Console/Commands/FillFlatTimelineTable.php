<?php

namespace App\Console\Commands;

use App\FlatTimeline;
use App\Http\Controllers\VulnerabilityTimelineController;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use App\NsiQueue;
use Illuminate\Support\Carbon;

class FillFlatTimelineTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:timeline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fill flat_timeline table';


    /**
     * VulnerabilityTimelineController.
     *
     * @return void
     */
    protected $vulnerabilityTimelineController;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->vulnerabilityTimelineController = new VulnerabilityTimelineController();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo 'run FillFlatTimelineTable Cron job'. PHP_EOL;

        $queue = new NsiQueue();
        $lastScanDay = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            NsiQueue::getLastScanDate()
        );

        //Data for Net Vulnerabilities chart
        $totalVIN = $this->vulnerabilityTimelineController->getGroupedByDateVulnerabilitiesByType($lastScanDay->copy(), 'getVINForDate', 'VIN');
        $totalVOUT = $this->vulnerabilityTimelineController->getGroupedByDateVulnerabilitiesByType($lastScanDay->copy(), 'getVOUTForDate', 'VOUT');
        $totalNet = $this->vulnerabilityTimelineController->getGroupedByDateVulnerabilitiesByType($lastScanDay->copy(), 'getNetByDate', 'Net');

        //Data for Non Microsoft Vulnerabilities chart
        $nonMicrosoftVIN = $this->vulnerabilityTimelineController->getGroupedByDateVulnerabilitiesByType($lastScanDay->copy(), 'getVINForNonMicrofoftByDate', 'nonMicrosoftVIN');
        $nonMicrosoftVOUT = $this->vulnerabilityTimelineController->getGroupedByDateVulnerabilitiesByType($lastScanDay->copy(), 'getVOUTorNonMicrofoftByDate', 'nonMicrosoftVOUT');
        $nonMicrosoftNet = $this->vulnerabilityTimelineController->getGroupedByDateVulnerabilitiesByType($lastScanDay->copy(), 'getNetNonMicrosoftByDate', 'nonMicrosoftNet');

        //Data for Microsoft Vulnerabilities chart
        $microsoftVIN = $this->vulnerabilityTimelineController->getGroupedByDateVulnerabilitiesByType($lastScanDay->copy(), 'getVINForMicrofoftByDate', 'microsoftVIN');
        $microsoftVOUT = $this->vulnerabilityTimelineController->getGroupedByDateVulnerabilitiesByType($lastScanDay->copy(), 'getVOUTorMicrofoftByDate', 'microsoftVOUT');
        $microsoftNet = $this->vulnerabilityTimelineController->getGroupedByDateVulnerabilitiesByType($lastScanDay->copy(), 'getNetMicrosoftByDate', 'microsoftNet');

        FlatTimeline::create([
            'total_vin' => json_encode($totalVIN),
            'total_vout' => json_encode($totalVOUT),
            'total_net' => json_encode($totalNet),
            'non_microsoft_vin' => json_encode($nonMicrosoftVIN),
            'non_microsoft_vout' => json_encode($nonMicrosoftVOUT),
            'non_microsoft_net' => json_encode($nonMicrosoftNet),
            'microsoft_vin' => json_encode($microsoftVIN),
            'microsoft_vout' => json_encode($microsoftVOUT),
            'microsoft_net' => json_encode($microsoftNet),
        ]);

        $flatTimeline = FlatTimeline::get();

        if(count($flatTimeline) > 1){
            FlatTimeline::first()->delete();
        }
    }
}
