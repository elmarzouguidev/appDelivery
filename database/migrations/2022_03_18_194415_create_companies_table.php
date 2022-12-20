<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->uuid('user_uuid')->nullable();

            $table->uuid('uuid')->unique();
            $table->string('code')->unique()->nullable();

            $table->string('name')->unique();
            $table->string('website')->unique()->nullable();
            $table->string('logo')->nullable();
            $table->longText('description')->nullable();
            $table->string('city')->default('casablanca');
            $table->longText('addresse');

            $table->string('telephone')->nullable()->unique();
            $table->string('email')->nullable()->unique();

            $table->string('rc')->unique()->nullable();
            $table->string('ice')->unique()->nullable();
            $table->string('cnss')->unique()->nullable();
            $table->string('patente')->unique()->nullable();
            $table->string('if')->unique()->nullable();

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
        Schema::dropIfExists('companies');
    }
}
