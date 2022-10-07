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

            $table->foreignId('delivery_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('delivery_uuid')->nullable();


            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->string('city_uuid')->nullable();

            $table->string('qte_global')->default(0);
            $table->string('qte_livre')->default(0);
            $table->string('qte_expidite')->default(0);
            $table->string('qte_endomage')->default(0);
            $table->string('qte_rest')->default(0);

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
