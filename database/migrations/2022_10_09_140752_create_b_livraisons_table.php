<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_livraisons', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->string('full_number')->unique();

            $table->foreignId('user_id')->nullable();
            $table->uuid('user_uuid')->nullable();

            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->uuid('city_uuid')->nullable();

            $table->mediumText('notes')->nullable();
            $table->date('bon_date')->nullable();

            $table->boolean('active')->default(true);
            $table->boolean('closed')->default(false);

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
        Schema::dropIfExists('b_livraisons');
    }
}
