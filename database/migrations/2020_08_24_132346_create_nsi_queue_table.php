<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNsiQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nsi_queue', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->tinyInteger('status')->nullable();
            $table->dateTime('status_date')->nullable();
            $table->integer('account_id')->nullable();
            $table->string('langroup')->nullable();
            $table->string('host')->nullable();
            $table->string('sha1')->nullable();
            $table->tinyInteger('affect_ca')->nullable();
            $table->string('profile')->nullable();
            $table->string('process_id')->nullable();
            $table->tinyInteger('scan_type')->nullable();
            $table->integer('nsi_device_id')->nullable();
            $table->integer('no_insecure')->default(0);
            $table->integer('no_eol')->default(0);
            $table->integer('no_patched')->default(0);
            $table->integer('no_total')->default(0);
            $table->integer('no_score')->default(0);
            $table->string('special_path')->nullable();
            $table->integer('no_zombie')->nullable();
            $table->integer('software_inspector_id')->default(21);
            $table->string('software_inspector_version')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nsi_queue');
    }
}
