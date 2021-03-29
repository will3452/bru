<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('artist')->nullable();
            $table->string('genre')->nullable();
            $table->string('lead_college')->nullable();
            $table->string('age_restriction')->nullable();
            $table->string('cost')->nullable();
            $table->longText('file')->nullable();
            $table->timestamp('cpy')->nullable(); // copyright
            $table->softDeletes();
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
        Schema::dropIfExists('arts');
    }
}
