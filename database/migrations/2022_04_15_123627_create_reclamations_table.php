<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->string('code')->unique()->nullable();

            $table->foreignId('command_id')
                ->nullable()
                ->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained()->cascadeOnDelete();
            $table->longText('message');
            $table->boolean('active')->default(true);
            $table->integer('status')->default(0);

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
        Schema::dropIfExists('reclamations');
    }
}
