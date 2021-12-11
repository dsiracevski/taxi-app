<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDriverCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained();
            $table->foreignId('car_id')->constrained();
            $table->string('note')->nullable();
            $table->string('km')->nullable();
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
        Schema::dropIfExists('table_driver_cars');
    }
}
