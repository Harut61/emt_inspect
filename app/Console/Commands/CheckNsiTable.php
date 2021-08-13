<?php

namespace App\Console\Commands;

use App\NsiQueue;
use App\NsiResult;
use Illuminate\Console\Command;

class CheckNsiTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nsi:table_check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check nsi table';

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
        echo 'run CheckNsiTable Cron job'. PHP_EOL;

        //delete  NsiQueue and NsiQueue rows relative with NsiQueue when nsi_device_id = null
        NsiQueue::where('nsi_device_id', '=', null)->chunk(100, function ($nsiQueue) {
            foreach ($nsiQueue as $item){
                NsiResult::where('queue_id', $item->id)->delete();
            }
        });

        NsiQueue::where('nsi_device_id', '=', null)->delete();

        //delete  NsiQueue and NsiQueue rows relative with NsiQueue older from one week
        $olderNsiQueue = NsiQueue::whereDate('status_date', '<=', now()->subDays(49)
            ->setTime(0, 0, 0)->toDateTimeString())
            ->chunk(100, function ($olderNsiQueue) {
                foreach ($olderNsiQueue as $item){
                    NsiResult::where('queue_id', $item->id)->delete();
                }
            });

        NsiQueue::whereDate('status_date', '<=', now()->subDays(49)->setTime(0, 0, 0)->toDateTimeString())
            ->delete();

        //delete  NsiQueue and NsiQueue rows relative with NsiQueue from groped by host
        $nsiQueueGrouped = \DB::select('SELECT  id FROM `nsi_queue` GROUP By `host`, DATE(`status_date`)');
        $ids = [];
        foreach ($nsiQueueGrouped as $item){
            $ids[] = $item->id;
        }

        NsiQueue::whereNotIn('id', $ids)->delete();
        NsiResult::whereNotIn('queue_id', $ids)->delete();
    }
}
