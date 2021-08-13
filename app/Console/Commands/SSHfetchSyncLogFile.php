<?php

namespace App\Console\Commands;

use App\Helpers\RemoteHelper as SSH;
use Illuminate\Console\Command;
use Exception;
use Illuminate\Support\Facades\Storage;

class SSHfetchSyncLogFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ssh:hetch_sync_log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loads sync.log file from server and merges it with local.';

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
            SSH::run("scp ".env('SSH_USERNAME') . '@' . env('SSH_HOST')." :/usr/local/Secunia/csi/log/sync.log /var/www/emt-inspect/storage/app/servers_logs/sync.log" );
        } catch (Exception $exception) {
            echo "Failed to connect to the server!" . PHP_EOL;
        }
    }
}
