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
            $table->string('skin')->default('0');
            $table->string('head')->default('0');
            $table->string('faceshape')->default('0');
            $table->string('facehair')->default('0');
            $table->string('hair')->default('0');
            $table->string('eyes')->default('0');
            $table->string('eyebrows')->default('0');
            $table->string('nose')->default('0');
            $table->string('lips')->default('0');
            $table->string('pe')->default('0');
            $table->string('accesories')->default('0');
            $table->string('outfit')->default('0');
            $table->string('shoes')->default('0');
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
