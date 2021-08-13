<?php

namespace App\Console\Commands;

use App\ServiceHealth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UpdateRemtoeDbType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remotedb:type';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the remote db type';

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
        Artisan::call('config:cache');
        
        $dbService = ServiceHealth::whereIn('name', ['mariadb', 'mysql'])->first();
        
        $dbService->update([
            'name' => config('sshServices.mysql_type'),
            'public_name' => config('sshServices.services.' . config('sshServices.mysql_type') . '.public_name')
        ]);
        
        return 0;
    }
}
