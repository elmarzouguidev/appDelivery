<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique()->nullable();

            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->unique();

            $table->string('cnie')->unique()->nullable();

            $table->string('rc')->unique()->nullable();
            $table->string('ice')->unique()->nullable();
            $table->string('cnss')->unique()->nullable();
            $table->string('patente')->unique()->nullable();
            $table->string('if')->unique()->nullable();

            $table->longText('addresse')->nullable();
            $table->string('city')->nullable();
            
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            $table->boolean('active')->default(true);
            $table->enum('type',['user','entreprise','particulier'])->default('user');
            $table->rememberToken();
            $table->boolean('is_admin')->default(false);
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
        Schema::dropIfExists('users');
    }
}
