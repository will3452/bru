<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->timestamps();
        });


        Schema::create('boxables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('box_id');
            $table->foreignId('boxable_id');
            $table->string('boxable_type');
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
        Schema::dropIfExists('boxes');
        Schema::dropIfExists('boxables');
    }
}
