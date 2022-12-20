<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfitToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->after('frais', function ($table) {
                $table->float('profit')->default(0)->nullable();
            });
        });

        Schema::table('delivery_invoice_articles', function (Blueprint $table) {
            $table->after('frais', function ($table) {
                $table->float('profit')->default(0)->nullable();
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
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('profit');
        });
        Schema::table('delivery_invoice_articles', function (Blueprint $table) {
            $table->dropColumn('profit');
        });
    }
}
