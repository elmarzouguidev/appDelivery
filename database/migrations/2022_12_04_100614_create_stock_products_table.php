<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('stock_id')->constrained()->cascadeOnDelete();
            $table->string('stock_uuid')->nullable();

            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->string('city_uuid')->nullable();

            $table->foreignId('delivery_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('delivery_uuid')->nullable(); 

            $table->string('qte_global')->default(0);
            $table->string('qte_livre')->default(0);
            $table->string('qte_expidite')->default(0);
            $table->string('qte_endomage')->default(0);
            $table->string('qte_rest')->default(0);

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
        Schema::dropIfExists('stock_products');
    }
}
