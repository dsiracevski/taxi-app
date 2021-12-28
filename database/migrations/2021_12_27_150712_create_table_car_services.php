<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCarServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->integer('driver_id');
            $table->integer('gas_price')->nullable();
            $table->enum('gas_type', ['diesel', 'petrol'])->nullable();
            $table->string('km');
            $table->integer('user_id')->default(0);
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
        Schema::dropIfExists('table_car_services');
    }
}
