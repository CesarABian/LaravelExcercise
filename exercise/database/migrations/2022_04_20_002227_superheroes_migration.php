<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SuperheroesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superheroes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fullname');
            $table->integer('strength');
            $table->integer('speed');
            $table->integer('durability');
            $table->integer('power');
            $table->integer('combat');
            $table->string('race');
            $table->string('height_0');
            $table->string('height_1');
            $table->string('weight_0');
            $table->string('weight_1');
            $table->string('eyecolor');
            $table->string('haircolor');
            $table->string('publisher');
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
        Schema::dropIfExists('superheroes');
    }
}
