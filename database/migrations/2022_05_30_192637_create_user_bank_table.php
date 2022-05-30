<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bank', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->nullable();

            $table->foreignId('user_id')
                ->index();
            $table->uuid('user_uuid')
                ->nullable();

            $table->foreignId('bank_id')
                ->index();

            $table->uuid('bank_uuid')
                ->nullable();

            $table->string('rib');
            
            $table->enum('type', ['client', 'delivery'])->default('client');

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
        Schema::dropIfExists('user_bank');
    }
}
