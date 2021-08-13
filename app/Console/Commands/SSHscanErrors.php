<?php

namespace App\Console\Commands;

use App\Helpers\RemoteHelper as SSH;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Exception;
use Illuminate\Support\Facades\Storage;

class SSHscanErrors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ssh:scan_errors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks services status and stores last error logs.';

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
                        if ($output == "failed") {
                            Storage::append("server_logs/services/{$seviceName}/error.log", '');

                            SSH::run(
                                "systemctl status {$seviceName}.service",
                                function ($output) use ($seviceName) {
                                    $stringsArray = explode('\n', $output);
                                    $errors = preg_grep('/^[A-Z][a-z]{2} [0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}/', $stringsArray);
                                    $errors = array_pop($errors);

                                    $data = explode(' ', $errors, 4);
                                    if (count($data) > 3) {
                                        $date = Carbon::createFromFormat('M d H:i:s', "{$data[0]} {$data[1]} {$data[2]}");

                                        Storage::append(
                                            "server_logs/services/{$seviceName}/error.log",
                                            "[{$date->format('Y-m-d H:i:s')}]{$data[3]}"
                                        );
                                    }
                                }
                            );
                        } elseif ($output == "unknown") {
                            $currentDate = Carbon::createFromFormat('Y-m-d H:i:s', now());

                            Storage::append(
                                "server_logs/services/{$seviceName}/error.log",
                                "[{$currentDate}]Unit {$seviceName}.service could not be found."
                            );
                        }
                    }
                );
            } catch (Exception $exception) {
                echo "Failed to tonnect to the server!" . PHP_EOL;
            }
        }
    }
}
