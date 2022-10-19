<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->string('full_number')->unique();

            $table->float('price_ht')->default(0)->nullable();
            $table->float('price_total')->default(0)->nullable();
            $table->float('price_tva')->default(0)->nullable();

            $table->date('invoice_date')->nullable();
    
            $table->foreignId('delivery_id')->constrained();
            $table->uuid('delivery_uuid')->nullable();

            $table->foreignId('city_id')->nullable()->constrained();
            $table->uuid('city_uuid')->nullable();

            $table->boolean('cloture')->default(false);

            $table->boolean('active')->default(true);
            
            $table->mediumText('condition_general')->nullable();

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
        Schema::dropIfExists('delivery_invoices');
    }
}
