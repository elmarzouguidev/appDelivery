<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustment_details', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('product_id')->index('adjust_product_id');
            $table->unsignedBigInteger('adjustment_id')->index('adjust_adjustment_id');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->string('type', 192);
            $table->timestamps();

            $table->foreign('adjustment_id', 'adjust_adjustment_id')->references('id')->on('adjustments')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('product_id', 'adjust_product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjustment_details');
    }
}
