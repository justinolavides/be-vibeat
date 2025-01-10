<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicTable extends Migration
{
    public function up()
    {
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            $table->string('album')->nullable();
            $table->integer('year')->nullable();
            $table->string('audio_url'); // Add the URL for the audio file
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('music');
    }
}
