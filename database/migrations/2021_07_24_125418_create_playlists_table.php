<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->timestamps();
        });

        Schema::create('playlistables', function(Blueprint $table){
            $table->foreignId('playlist_id');
            $table->string('playlistable_type');
            $table->foreignId('playlistable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlists');
        Schema::dropIfExists('playlistables');
    }
}
