<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('type'); // for book, songs, art, film and podcast
            $table->string('type_of_work');// for collaboration or solo work
            $table->foreignId('group_id')->nullable();
            $table->string('title');
            $table->text('desc');
            $table->text('credits');
            $table->text('cover');
            $table->text('cpy');
            $table->timestamps();
        });

        Schema::create('seriesable', function(Blueprint $table){
            $table->id();
            $table->foreignId('seriesable_id');
            $table->string('seriesable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series');
        Schema::dropIfExists('seriesable');
    }
}
