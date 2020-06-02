<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillingStationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filling_station_user', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('filling_station_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('filling_station_id')->references('id')->on('filling_stations');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('filling_station_user');
    }
}
