<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('genre')->nullable();
            $table->string('artist')->nullable();
            $table->string('composer')->nullable();
            $table->string('lyricist')->nullable();
            $table->text('description')->nullable();
            $table->text('credits')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('book_id')->nullable();
            $table->foreignId('audio_id')->nullable();
            $table->foreignId('art_id')->nullable();
            $table->foreignId('thrailer_id')->nullable();
            $table->string('repeated')->default('false');
            $table->string('cost_type');
            $table->string('cost');
            $table->text('cover')->nullable();
            $table->text('copyright')->nullable();
            $table->string('cover_cpy')->default('false');
            $table->text('file');
            $table->string('associated_type')->nullable();
            $table->string('artist_others')->nullable();
            $table->string('composer_others')->nullable();
            $table->string('lyricist_others')->nullable();
            $table->string('is_copyright')->nullable();
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
        Schema::dropIfExists('songs');
    }
}
