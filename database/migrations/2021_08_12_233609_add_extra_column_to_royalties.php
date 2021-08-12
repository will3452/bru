<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnToRoyalties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('royalties', function (Blueprint $table) {
            $table->integer('spin_off')->default(0);
            $table->integer('free_item')->default(0);
            $table->integer('free_art_scene')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('royalties', function (Blueprint $table) {
            $table->dropColumn('spin_off');
        });
    }
}
