<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_company', function (Blueprint $table) {

            $table->id();
            
            $table->foreignId('delivery_id')->nullable();
            $table->uuid('delivery_uuid')->nullable();

            $table->foreignId('sub_delivery_id')->nullable();
            $table->uuid('sub_delivery_uuid')->nullable();
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
        Schema::dropIfExists('delivery_company');
    }
}
