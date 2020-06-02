<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOilRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oil_records', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity')->unsigned();
            $table->integer('price_per_litre')->unsigned();
            $table->integer('paid_per_litre')->unsigned()->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('filling_station_id')->unsigned();
            $table->bigInteger('profile_id')->unsigned();
            $table->string('status')->default('unpaid');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('filling_station_id')->references('id')->on('filling_stations')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');

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
        Schema::dropIfExists('oil_records');
    }
}
