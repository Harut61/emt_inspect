<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceHealthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_healths', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('fail_time')->nullable();
            $table->boolean('running');
            $table->string('public_name')->nullable();
            $table->string('description')->nullable();
            $table->string('flaticon_name')->nullable();
            $table->string('css_class')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_healths');
    }
}
