<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id')->index('user_id_adjustment')->nullable();
            $table->date('date');
            $table->string('Ref', 192);
            $table->unsignedBigInteger('city_id')->index('city_id_adjustment');
            $table->float('items', 10, 0)->nullable()->default(0);
            $table->text('notes')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id', 'user_id_adjustment')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('city_id', 'city_id_adjustment')->references('id')->on('cities')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjustments');
    }
}
