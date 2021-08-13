<?php

namespace App\Console;

use App\Console\Commands\CheckNsiTable;
use App\Console\Commands\FetchRemoteTables;
use App\Console\Commands\FillFlatDetailVulnerabilityLists;
use App\Console\Commands\FillFlatDetailVulnerabilityWeek;
use App\Console\Commands\FillFlatReportingQuickLinks;
use App\Console\Commands\FillFlatTimelineTable;
use App\Console\Commands\FillFlatVulnerabilityByDate;
use App\Console\Commands\RunAllFlatCommands;
use App\Console\Commands\SSHdiskSpaceCheck;
use App\Console\Commands\SSHFetch;
use App\Console\Commands\SSHfetchSyncLogFile;
use App\Console\Commands\SSHscanErrors;
use App\FlatDetailVulnerabilityList;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        FetchRemoteTables::class,
        SSHdiskSpaceCheck::class,
        SSHFetch::class,
        SSHfetchSyncLogFile::class,
        SSHscanErrors::class,
        FillFlatTimelineTable::class,
        FillFlatReportingQuickLinks::class,
        FillFlatDetailVulnerabilityLists::class,
        FillFlatDetailVulnerabilityWeek::class,
        FillFlatVulnerabilityByDate::class,
        CheckNsiTable::class,
        RunAllFlatCommands::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('db_fetch:day')->dailyAt('00:00')->then(function() {
            $this->call('nsi:table_check')->then(function() {
                $this->call('fill:timeline')->then(function() {
                    $this->call('fill:DetailVulnerability')->then(function() {
                        $this->call('fill:reportingQuickLinks')->then(function() {
                            $this->call('fill:DetailVulnerabilityWeek')->then(function() {
                                $this->call('fill:flatVulnerabilityByDate');
                            });
                        });
                    });
                });
            });
        });
        $schedule->command('ssh:disk')->dailyAt('00:00');
        $schedule->command('ssh:fetch_services_status')->everyFiveMinutes();
        $schedule->command('ssh:scan_errors')->everyFiveMinutes();
        $schedule->command('ssh:hetch_sync_log')->everyFiveMinutes();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
