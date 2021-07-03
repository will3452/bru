<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        												//variables.password = 'testpassword2'; 
// skin
// head
// faceshape
// facehair
// hair
// eyes
// eyebrows
// nose
// lips
// pe
// accesories
// outfit
// shoes
        Schema::create('avatars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('skin')->nullable();
            $table->string('head')->nullable();
            $table->string('faceshape')->nullable();
            $table->string('facehair')->nullable();
            $table->string('hair')->nullable();
            $table->string('eyes')->nullable();
            $table->string('eyebrows')->nullable();
            $table->string('nose')->nullable();
            $table->string('lips')->nullable();
            $table->string('pe')->nullable();
            $table->string('accesories')->nullable();
            $table->string('outfit')->nullable();
            $table->string('shoes')->nullable();
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
        Schema::dropIfExists('avatars');
    }
}
