<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlamodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plamodels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('maker')->nullable();
            $table->integer('price')->nullable();
            $table->integer('released')->nullable();
            $table->string('point')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('plamodels');
    }
}
