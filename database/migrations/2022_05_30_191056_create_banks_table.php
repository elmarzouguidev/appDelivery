<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name')->unique();
            $table->string('code_bank')->nullable();
            $table->string('code_swift')->nullable();
            $table->string('code_rib')->nullable();
            $table->string('logo')->nullable();
            $table->longText('addresse')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('banks');
    }
}
