<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_deliveries', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
      
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->unique()->nullable();
            $table->string('cnie')->unique()->nullable();
            
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            $table->boolean('active')->default(true);

            $table->foreignId('user_id')->nullable();
            $table->uuid('user_uuid')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('deliveries');
    }
}
