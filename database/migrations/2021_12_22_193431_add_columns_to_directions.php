<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDirections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('directions', function (Blueprint $table) {
            $table->string("price_idle")->default(0);
            $table->string("price_order")->default(0);
            $table->string("street_number_from")->nullable();
            $table->string("street_number_to")->nullable();
            $table->boolean("invoice")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('driver_cars', function($table) {
            $table->dropColumn('price_idle');
            $table->dropColumn('price_order');
            $table->dropColumn('street_number_from');
            $table->dropColumn('street_number_to');
            $table->dropColumn('invoice');
        });
    }
}
