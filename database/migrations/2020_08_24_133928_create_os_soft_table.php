<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOsSoftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os_soft', function (Blueprint $table) {
            $table->unsignedInteger('os_soft_id')->primary();
            $table->string('os_soft_name')->nullable();
            $table->string('os_soft_version')->nullable();
            $table->tinyInteger('os_soft_type')->nullable();
            $table->string('os_soft_sec_page', 500)->nullable();
            $table->string('os_soft_prod_page', 500)->nullable();
            $table->integer('vendor_id')->nullable();
            $table->tinyInteger('dont_display')->nullable();
            $table->text('aliases')->nullable();
            $table->text('internal_comment')->nullable();
            $table->string('os_soft_group')->nullable();
            $table->string('secure_browsing_tags')->nullable();
            $table->timestamp('sync_updated')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string('updated_by')->nullable();
            $table->tinyInteger('eol')->nullable();
            $table->mediumText('vendor_description')->nullable();
            $table->integer('upstream_product')->nullable();
            $table->tinyInteger('os_soft_track')->nullable()->default(0);
            $table->string('os_soft_product_family')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('os_soft');
    }
}
