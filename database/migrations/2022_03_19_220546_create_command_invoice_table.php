<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command_invoice', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->nullable();

            $table->foreignId('command_id')
                ->index()
                ->constrained();

            $table->foreignId('invoice_id')
                ->index()
                ->constrained();

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
        Schema::dropIfExists('command_invoice');
    }
}
