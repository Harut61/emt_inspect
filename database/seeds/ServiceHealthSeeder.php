<?php

use App\ServiceHealth;
use Illuminate\Database\Seeder;

class ServiceHealthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['scandaemon', 'sgdaemon', config('sshServices.mysql_type'), 'httpd'];
            
        foreach ($services as $service) {
            ServiceHealth::create([
                'name' => $service,
                'fail_time' => now(),
                'running' => 0,
                'public_name' => config('sshServices.services.' . $service . '.public_name'),
                'description' => config('sshServices.services.' . $service . '.description'),
                'flaticon_name' => config('sshServices.services.' . $service . '.flaticon_name'),
                'css_class' => config('sshServices.services.' . $service . '.css_class'),
            ]);
        }
    }
}
