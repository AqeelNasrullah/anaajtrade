<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFertilizerStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fertilizer_stocks', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity')->unsigned();
            $table->integer('price')->unsigned();
            $table->string('type');
            $table->integer('weight')->unsigned();

            $table->bigInteger('fertilizer_trader_id')->unsigned();
            $table->foreign('fertilizer_trader_id')->references('id')->on('fertilizer_traders');
            $table->bigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('fertilizer_stocks');
    }
}
