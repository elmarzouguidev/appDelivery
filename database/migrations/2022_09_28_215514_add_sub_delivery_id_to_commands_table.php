<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubDeliveryIdToCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commands', function (Blueprint $table) {
            $table->after('delivery_uuid', function ($table) {

                $table->foreignId('sub_delivery_id')->nullable();
                $table->uuid('sub_delivery_uuid')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commands', function (Blueprint $table) {
            $table->dropColumn(['sub_delivery_id', 'sub_delivery_uuid']);
        });
    }
}
