<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlatformToSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasColumn('sources', 'platform')) {

            Schema::table('sources', function (Blueprint $table) {
                $table->string('platform')->after('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('sources', 'platform')) {

            Schema::table('sources', function (Blueprint $table) {
                $table->dropColumn('platform');
            });
        }
    }
}
