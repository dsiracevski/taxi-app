<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('directions', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE `taxi_shlivka`.`directions`
                CHANGE `price` `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '',
                CHANGE `price_idle` `price_idle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '0' COMMENT '',
                CHANGE `location_to_id` `location_to_id` int(11) NULL COMMENT '',
                CHANGE `return` `return` tinyint(4) NULL DEFAULT '0' COMMENT '',
                CHANGE `price_order` `price_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '0' COMMENT '';");
            });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
