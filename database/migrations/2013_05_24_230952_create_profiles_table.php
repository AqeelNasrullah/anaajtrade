<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->string('avatar')->default('avatar.jpg');
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('phone_number')->unique();
            $table->string('cnic')->unique();
            $table->text('address');
            $table->integer('property')->nullable();
            $table->bigInteger('role_id')->unsigned()->default(3);

            $table->foreign('role_id')->references('id')->on('roles');

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
        Schema::dropIfExists('profiles');
    }
}
