<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVulnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuln', function (Blueprint $table) {
            $table->integerIncrements('vuln_id');
            $table->string('vuln_title')->nullable();
            $table->date('vuln_create_date')->nullable();
            $table->dateTime('vuln_modified_date')->nullable();
            $table->tinyInteger('vuln_status')->nullable();
            $table->float('vuln_revision')->nullable();
            $table->date('vuln_disclosure_date')->nullable();
            $table->date('vuln_discovery_date')->nullable();
            $table->date('vuln_exploit_publish_date')->nullable();
            $table->tinyInteger('vuln_critical_boolean')->nullable();
            $table->integer('lang_id')->nullable();
            $table->tinyInteger('vuln_top_place')->nullable();
            $table->tinyInteger('vuln_solution_status')->nullable();
            $table->integer('vuln_count')->nullable();
            $table->dateTime('vuln_released')->nullable();
            $table->string('vuln_cvss_vector')->nullable();
            $table->float('vuln_cvss_score')->nullable();
            $table->tinyInteger('vuln_others')->nullable()->default(0);
            $table->tinyInteger('vuln_zero_day')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vuln');
    }
}
