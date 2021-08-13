<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNsiResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nsi_result', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->integer('queue_id')->nullable();
            $table->string('path')->nullable();
            $table->string('version')->nullable();
            $table->integer('version_rule_id')->nullable();
            $table->tinyInteger('secure')->nullable();
            $table->tinyInteger('eol')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('secure_version')->nullable();
            $table->tinyInteger('unpatched')->nullable();
            $table->integer('vuln_id')->nullable();
            $table->text('missing_ms_kb')->nullable();
            $table->string('special_path')->nullable();
            $table->integer('arch')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nsi_result');
    }
}
