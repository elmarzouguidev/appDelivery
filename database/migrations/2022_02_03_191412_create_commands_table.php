<?php

use App\Status\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commands', function (Blueprint $table) {
            
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->string('track_code')->unique();

            $table->integer('status')->default(Status::NON_TRAITE);
            $table->boolean('is_closed')->default(false);
            $table->boolean('is_imported')->default(false);

            $table->foreignId('user_id')->index()->constrained()->cascadeOnDelete();
            $table->uuid('user_uuid')->nullable();
            
            $table->foreignId('city_id')->index()->nullable();

            $table->string('client_email')->nullable();
            $table->string('client_phone');
            $table->string('client_name');
            $table->longText('client_address');
            $table->string('client_city')->nullable();

            $table->longText('comment')->nullable();

            $table->string('price_total')->default(0);
            
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
        Schema::dropIfExists('commands');
    }
}
