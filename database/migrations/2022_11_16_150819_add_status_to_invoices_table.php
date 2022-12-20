<?php

use App\Status\InvoiceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->after('active', function ($table) {
                $table->integer('status')->default(InvoiceStatus::NON_PAYEE);
            });
        });

        Schema::table('delivery_invoices', function (Blueprint $table) {
            $table->after('active', function ($table) {
                $table->integer('status')->default(InvoiceStatus::NON_PAYEE);
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
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('delivery_invoices', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
