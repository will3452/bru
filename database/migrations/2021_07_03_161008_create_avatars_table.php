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
            $table->foreignId('user_id')->nullable();
            $table->string('skin')->default('NONE');
            $table->string('head')->default('NONE');
            $table->string('faceshape')->default('NONE');
            $table->string('facehair')->default('NONE');
            $table->string('hair')->default('NONE');
            $table->string('eyes')->default('NONE');
            $table->string('eyebrows')->default('NONE');
            $table->string('nose')->default('NONE');
            $table->string('lips')->default('NONE');
            $table->string('pe')->default('NONE');
            $table->string('accesories')->default('NONE');
            $table->string('outfit')->default('NONE');
            $table->string('shoes')->default('NONE');
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
