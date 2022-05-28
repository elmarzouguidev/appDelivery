<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRamassagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramassages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->longText('addresse')->nullable();
            
            $table->foreignId('product_id')->index()->nullable();
            $table->uuid('product_uuid')->nullable();
            $table->foreignId('client_id')->index()->nullable();
            $table->uuid('client_uuid')->nullable();

            $table->boolean('active')->default(false);

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
        Schema::dropIfExists('ramassages');
    }
}
