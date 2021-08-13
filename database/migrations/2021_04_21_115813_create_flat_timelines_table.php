<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flat_timelines', function (Blueprint $table) {
            $table->id();
            $table->longText('total_vin');
            $table->longText('total_vout');
            $table->longText('total_net');
            $table->longText('non_microsoft_vin');
            $table->longText('non_microsoft_vout');
            $table->longText('non_microsoft_net');
            $table->longText('microsoft_vin');
            $table->longText('microsoft_vout');
            $table->longText('microsoft_net');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flat_timelines');
    }
}
