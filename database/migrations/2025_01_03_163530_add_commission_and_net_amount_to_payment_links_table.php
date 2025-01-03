<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_links', function (Blueprint $table) {
            $table->decimal('commission', 10, 2)->default(0.00); // Ajoute la colonne commission
            $table->decimal('net_amount', 10, 2)->default(0.00); // Ajoute la colonne net_amount
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_links', function (Blueprint $table) {
            $table->dropColumn('commission');
            $table->dropColumn('net_amount');
        });
    }
};
