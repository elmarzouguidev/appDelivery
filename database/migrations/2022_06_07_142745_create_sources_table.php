<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('integration_id')->constrained();
            $table->uuid('integration_uuid');

            $table->foreignId('user_id')->constrained();
            $table->uuid('user_uuid');

            $table->string('domain')->unique();
            $table->longText('token')->nullable();
            $table->string('options')->nullable();
            $table->string('url')->unique();
            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('sources');
    }
}
