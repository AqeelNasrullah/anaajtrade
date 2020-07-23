<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_records', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity')->unsigned();
            $table->integer('price')->unsigned();
            $table->integer('paid')->unsigned();
            $table->string('type');

            $table->bigInteger('medicine_type_id')->unsigned();
            $table->foreign('medicine_type_id')->references('id')->on('medicine_types');

            $table->bigInteger('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles');

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
        Schema::dropIfExists('medicine_records');
    }
}
