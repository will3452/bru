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
            $table->string('skin')->default('');
            $table->string('head')->default('');
            $table->string('faceshape')->default('');
            $table->string('facehair')->default('');
            $table->string('hair')->default('');
            $table->string('eyes')->default('');
            $table->string('eyebrows')->default('');
            $table->string('nose')->default('');
            $table->string('lips')->default('');
            $table->string('pe')->default('');
            $table->string('accesories')->default('');
            $table->string('outfit')->default('');
            $table->string('shoes')->default('');
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
