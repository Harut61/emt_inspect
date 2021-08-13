<?php

namespace App\Console\Commands;

use App\Helpers\RemoteHelper as SSH;
use App\DiskSpaceResult;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Exception;

class SSHdiskSpaceCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ssh:disk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks available disk space on server';

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
        try {
            SSH::run("echo -n $(df -T | grep '\/$' | awk '{print $6}' | sed s/%//)", function ($output) {
                $diskUseagePrecent = $output;

                $diskSpaceResult = new DiskSpaceResult;
                $time = Carbon::createFromFormat('Y-m-d H:i:s', now());

                $diskSpaceResult->usage = $diskUseagePrecent;
                $diskSpaceResult->scan_date = $time;

                $diskSpaceResult->save();
            });
        } catch (Exception $exception) {
            echo "Failed to connect to the server!" . PHP_EOL;
        }
    }
}
