<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            
            $table->id();

            $table->uuid('uuid');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('active')->default(true);
            $table->date('periode')->nullable();

            $table->foreignId('user_id')->nullable()->constrained();
    

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
        Schema::dropIfExists('annonces');
    }
}
