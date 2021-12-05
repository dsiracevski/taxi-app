<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDirections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_directions', function (Blueprint $table) {
            $table->id();
            $table->integer("driver_id");
            $table->integer("location_from_id");
            $table->integer("location_to_id");
            $table->string('price');
            $table->tinyInteger('scheduled')->default(0);
            $table->integer('user_id');
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
        Schema::dropIfExists('table_directions');
    }
}
