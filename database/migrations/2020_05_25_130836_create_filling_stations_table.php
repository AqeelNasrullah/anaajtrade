<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillingStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filling_stations', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('phone_number')->unique();
            $table->text('address')->nullable();
            $table->bigInteger('oil_company_id')->unsigned();

            $table->foreign('oil_company_id')->references('id')->on('oil_companies');

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
        Schema::dropIfExists('filling_stations');
    }
}
