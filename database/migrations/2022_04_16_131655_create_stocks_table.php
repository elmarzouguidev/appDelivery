<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->boolean('is_default')->default(false);

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('product_uuid')->nullable();

            $table->foreignId('client_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('client_uuid')->nullable();

  
            $table->longText('notes')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('stocks');
    }
}
