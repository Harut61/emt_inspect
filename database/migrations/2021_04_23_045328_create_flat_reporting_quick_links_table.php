<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatReportingQuickLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flat_reporting_quick_links', function (Blueprint $table) {
            $table->id();
            $table->longText('services_health');
            $table->longText('vin');
            $table->longText('vout');
            $table->longText('net_non_microsoft');
            $table->longText('net_microsoft');
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
        Schema::dropIfExists('flat_reporting_quick_links');
    }
}
