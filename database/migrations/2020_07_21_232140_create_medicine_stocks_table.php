<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_stocks', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity')->unsigned();
            $table->integer('price')->unsigned();
            $table->string('type');

            $table->bigInteger('medicine_type_id')->unsigned();
            $table->foreign('medicine_type_id')->references('id')->on('medicine_types');
            $table->bigInteger('medicine_trader_id')->unsigned();
            $table->foreign('medicine_trader_id')->references('id')->on('medicine_traders');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('status')->default('unpaid');

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
        Schema::dropIfExists('medicine_stocks');
    }
}
