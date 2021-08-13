<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSshResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssh_results', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            
            $services = ['httpd', config('sshServices.mysql_type'), 'sgdaemon', 'scandaemon'];
            
            foreach ($services as $service) {
                $table->string($service);
            }
            
            $table->timestamp('time_created')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ssh_results');
    }
}
