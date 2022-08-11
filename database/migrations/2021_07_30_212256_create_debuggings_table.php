<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebuggingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debuggings', function (Blueprint $table) {
            $table->id();
            $table->longText('script');
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debuggings');
    }
}
