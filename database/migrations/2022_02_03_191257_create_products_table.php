<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();

            $table->string('name');
            $table->longText('description')->nullable();
            $table->float('price')->default(0);
            $table->string('sku')->nullable();

            $table->unsignedBigInteger('qte_global')->default(0);
            $table->unsignedBigInteger('qte_livre')->default(0);
            $table->unsignedBigInteger('qte_expidite')->default(0);
            $table->unsignedBigInteger('qte_endomage')->default(0);
            $table->unsignedBigInteger('qte_rest')->default(0);

            $table->boolean('active')->default(true);

            $table->foreignId('client_id')->index()->constrained();
            $table->foreignId('category_id')->index()->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
