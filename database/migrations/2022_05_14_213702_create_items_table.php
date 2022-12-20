<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('code')->unique()->nullable();

            $table->foreignId('command_id')->constrained()->cascadeOnDelete();
            $table->uuid('command_uuid')->nullable();

            $table->foreignId('product_id')->nullable();
            $table->uuid('product_uuid')->nullable();

            $table->longText('designation')->nullable();

            $table->string('product');

            $table->unsignedBigInteger('quantity');

            $table->string('prix_uni')->default(0);

            $table->string('prix_total')->default(0);

            $table->json('options')->nullable();

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
        Schema::dropIfExists('items');
    }
}
