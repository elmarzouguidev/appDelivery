<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->string('full_number')->unique();

            $table->unsignedDecimal('price_ht', 8, 2)->default(0)->nullable();
            $table->unsignedDecimal('price_total', 8, 2)->default(0)->nullable();
            $table->unsignedDecimal('price_tva', 8, 2)->default(0)->nullable();

            $table->date('invoice_date')->nullable();
    
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->uuid('user_uuid')->nullable();

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
        Schema::dropIfExists('invoices');
    }
}
