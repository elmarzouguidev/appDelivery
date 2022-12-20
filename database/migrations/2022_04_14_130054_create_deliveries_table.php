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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->unique()->nullable();
            $table->string('cnie')->unique()->nullable();

            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            $table->boolean('is_company')->default(false);
            $table->string('company_name')->nullable();

            $table->boolean('active')->default(true);

            $table->foreignId('parent_id')->nullable();
            $table->uuid('parent_uuid')->nullable();

            $table->foreignId('city_id')->nullable();
            $table->uuid('city_uuid')->nullable();

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
