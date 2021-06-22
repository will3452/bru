<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->foreignId('group_id')->nullable();
            $table->string('title');
            $table->string('type_of_work');
            $table->text('desc')->nullable();
            $table->text('credits')->nullable();
            $table->text('cover');
            $table->timestamps();
        });

        Schema::create('collectionables', function(Blueprint $table){
            $table->id();
            $table->foreignId('collection_id');
            $table->foreignId('collectionable_id');
            $table->string('collectionable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
        Schema::dropIfExists('collectionables');
    }
}
