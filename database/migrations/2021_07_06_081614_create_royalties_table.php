<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoyaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('royalties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('hall_pass')->nullable();
            $table->bigInteger('white_crystal')->nullable();
            $table->bigInteger('silver_ticket')->nullable();
            $table->bigInteger('purple_crystal')->nullable();
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
        Schema::dropIfExists('royalties');
    }
}
