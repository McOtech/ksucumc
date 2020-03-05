<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCohortImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohort_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cohort_id');
            $table->string('image');
            $table->string('title');
            $table->timestamps();

            $table->index('cohort_id');

            $table->foreign('cohort_id')->references('id')->on('cohorts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cohort_images');
    }
}
