<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNsiMsKbArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nsi_ms_kb_articles', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('kb_article')->nullable();
            $table->dateTime('added')->nullable();
            $table->integer('vuln_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nsi_ms_kb_articles');
    }
}
