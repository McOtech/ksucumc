<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCohortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohorts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->text('about')->nullable();
            $table->string('policy')->nullable();
            $table->text('aboutContent')->nullable();
            $table->string('policyContent')->nullable();
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
        Schema::dropIfExists('cohorts');
    }
}
