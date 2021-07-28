<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorksToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('book_id')->nullable();
            $table->foreignId('song_id')->nullable();
            $table->foreignId('art_id')->nullable();
            $table->foreignId('thralier_id')->nullable();
            $table->foreignId('audio_id')->nullable();
            $table->foreignId('podcast_id')->nullable();
            $table->foreignId('series_id')->nullable();
            $table->foreignId('collection_id')->nullable();
            $table->foreignId('album_id')->nullable();
            $table->string('part_of')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['book_id', 'song_id', 'art_id', 'thrailer_id', 'audio_id', 'podcast_id', 'series_id', 'collection_id', 'album_id', 'part_of']);
        });
    }
}
