<?php

namespace App\Console\Commands;

use App\Helpers\RemoteHelper as SSH;
use App\ServiceHealth;
use Carbon\Carbon;
use Illuminate\Console\Command;

use Exception;

class SSHFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ssh:fetch_services_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching deamons info from server via ssh.';

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
        $services = ['scandaemon', 'sgdaemon', config('sshServices.mysql_type'), 'httpd'];

        foreach ($services as $seviceName) {
            try {
                SSH::run(
                    "systemctl is-active ${seviceName}.service",
                    function ($output) use ($seviceName) {
                        //Get service data.
                        /** @var ServiceHealth $serviveHealth */
                        $serviveHealth = ServiceHealth::where('name', $seviceName);
                        $serviveHealth = $serviveHealth->get()->first();

                        if ($output == "unknown" || $output == "inactive") {
                            $serviveHealth->update([
                                'start_time' => null,
                                'fail_time' => isset($serviveHealth->fail_time) ? $serviveHealth->fail_time :
                                    Carbon::createFromFormat('Y-m-d H:i:s', now()),
                                'running' => false
                            ]);
                        } elseif ($output == "active") {
                            $serviveHealth->update([
                                'start_time' => isset($serviveHealth->start_time) ? $serviveHealth->start_time :
                                    Carbon::createFromFormat('Y-m-d H:i:s', now()),
                                'fail_time' => null,
                                'running' => true
                            ]);
                        }
                    }
                );
            } catch (Exception $exception) {
                echo "Failed to tonnect to the server!" . PHP_EOL;
            }
        }
    }
}
