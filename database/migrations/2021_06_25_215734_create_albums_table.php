<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('type'); // songs, art
            $table->string('type_of_work');// for collaboration or solo work
            $table->foreignId('group_id')->nullable();
            $table->string('title');
            $table->text('desc');
            $table->text('credits');
            $table->text('cover');
            $table->text('cpy');
            $table->timestamps();
        });

        Schema::create('albumables', function(Blueprint $table){
            $table->id();
            $table->foreignId('album_id');
            $table->foreignId('albumable_id');
            $table->string('albumable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
        Schema::dropIfExists('albumables');
    }
}
