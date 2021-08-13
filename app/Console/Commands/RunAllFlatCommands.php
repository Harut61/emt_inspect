<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunAllFlatCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flat:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Artisan::call('nsi:table_check');
        Artisan::call('fill:timeline');
        Artisan::call('fill:DetailVulnerability');
        Artisan::call('fill:reportingQuickLinks');
        Artisan::call('fill:DetailVulnerabilityWeek');
        Artisan::call('fill:flatVulnerabilityByDate');
    }
}
