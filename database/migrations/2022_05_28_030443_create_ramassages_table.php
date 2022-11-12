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
        
            $table->string('name');
            $table->float('price')->default(0);
       
            $table->unsignedBigInteger('qte')->default(0);
            $table->longText('addresse');
            $table->longText('notes')->nullable();
      
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->uuid('user_uuid')->nullable();
            $table->foreignId('category_id')->index()->nullable();

            $table->foreignId('product_id')->nullable()->constrained();
            $table->uuid('product_uuid')->nullable();

            $table->boolean('active')->default(false);

            $table->boolean('accepted')->default(false);

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
