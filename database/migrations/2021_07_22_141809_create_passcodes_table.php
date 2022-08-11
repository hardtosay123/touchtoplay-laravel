<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasscodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passcodes', function (Blueprint $table) {
            $table->id();
            $table->string('passcode')->default('touch2play2021');
            $table->timestamps();
        });
        \App\Models\passcode::create(['passcode'=> 'touch2play2021']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passcodes');
    }
}
