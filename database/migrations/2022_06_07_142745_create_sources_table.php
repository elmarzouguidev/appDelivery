<?php

use App\Models\Sameleon\User;
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
            $table->foreignIdFor(User::class)->constrained();
            $table->uuid('user_uuid')->nullable();
            $table->string('name')->unique();
            $table->string('header')->nullable();
            $table->string('secret')->unique()->nullable();
            $table->string('domain')->unique();
            $table->string('route')->unique();
            $table->string('options')->nullable();
            $table->boolean('active')->default(false);

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
        Schema::dropIfExists('sources');
    }
}
