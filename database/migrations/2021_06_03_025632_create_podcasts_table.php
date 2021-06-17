<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('group_id')->nullable();
            $table->string('title');
            $table->string('part_of');
            $table->string('type_of_work'); // collab for solo
            $table->string('host');
            $table->text('desc');
            $table->text('audio_desc');
            $table->text('credits');
            $table->text('cover');
            $table->text('episode_type');
            $table->foreignId('series_id')->nullable();
            $table->string('episode_number')->nullable();
            $table->string('cost')->nullable();
            $table->text('file')->nullable();
            $table->timestamp('cpy')->nullable();
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
        Schema::dropIfExists('podcasts');
    }
}
