<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rice_records', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->integer('quantity')->unsigned();
            $table->integer('price_per_mann')->unsigned();
            $table->integer('paid_per_mann')->unsigned();
            $table->bigInteger('rice_type_id')->unsigned();
            $table->foreign('rice_type_id')->references('id')->on('rice_types');
            $table->string('category');
            $table->string('status')->nullable()->default('unpaid');

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
        Schema::dropIfExists('rice_records');
    }
}
