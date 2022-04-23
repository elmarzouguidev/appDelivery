<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCommandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_command', function (Blueprint $table) {

            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('code')->unique()->nullable();

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('command_id')->constrained()->cascadeOnDelete();
            $table->uuid('command_uuid')->nullable();

            $table->longText('designation')->nullable();

            $table->unsignedBigInteger('quantity');
            $table->float('price_ht')->default(0);

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
        Schema::dropIfExists('product_command');
    }
}
