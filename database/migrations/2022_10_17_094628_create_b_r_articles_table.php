<?php

use App\Status\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBRArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_r_articles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('b_router_id')->constrained()->cascadeOnDelete();
            $table->uuid('b_router_uuid')->nullable();

            $table->foreignId('command_id')->constrained()->cascadeOnDelete();
            $table->uuid('command_uuid')->nullable();

            $table->integer('command_status')->default(Status::RETOURNE);

            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->longText('address')->nullable();

            $table->longText('comment')->nullable();

            $table->string('price_total')->default(0);
            $table->date('bon_date')->nullable();
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
        Schema::dropIfExists('b_r_articles');
    }
}
