<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryInvoiceArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_invoice_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('command_id')->index()->nullable()->constrained()->cascadeOnDelete();
            $table->uuid('command_uuid')->nullable();
            $table->uuid('uuid')->unique();
            $table->string('code')->nullable();

            $table->bigInteger('articleable_id');
            $table->string('articleable_type');

            $table->string('code_command');
            $table->dateTime('date_command');
            $table->string('city')->nullable();
            $table->string('status')->nullable();
            $table->float('price_total')->default(0);
            $table->float('frais')->default(0);
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
        Schema::dropIfExists('delivery_invoice_articles');
    }
}
