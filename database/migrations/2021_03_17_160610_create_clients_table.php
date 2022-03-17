<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            
            $table->id();

            $table->foreignId('group_id')->nullable()->constrained();

            $table->uuid('uuid')->unique();
            $table->string('code')->unique()->nullable();

            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->unique();

            $table->string('cnie')->unique()->nullable();

            $table->longText('addresse')->nullable();
            $table->string('city')->nullable();
            
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            $table->boolean('active')->default(true);
            $table->enum('type',['entreprise','particulier'])->default('particulier');
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
        Schema::dropIfExists('clients');
    }
}
