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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('sname')->nullable();
            $table->string('image')->default('storage/default/avatar.png')->nullable();
            $table->string('sex')->nullable();
            $table->string('regno')->nullable();
            $table->string('course')->nullable();
            $table->string('phone')->nullable();
            $table->string('postalAddress')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('town')->nullable();
            $table->date('dob')->nullable();
            $table->date('doa')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
