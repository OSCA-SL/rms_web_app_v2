<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_artists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type'); // 1 - singer, 2 - music_director, 3 - song_writer, 4 - producer
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('song_id');
            $table->timestamps();

            $table->softDeletes();

            $table->index(['song_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_artists');
    }
}
