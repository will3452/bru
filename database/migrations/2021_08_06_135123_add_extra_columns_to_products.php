<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('x');
            $table->string('y');
            $table->string('width');
            $table->string('height');
            $table->string('crystal')->default('purple'); //white
            $table->string('category')->default('bodywear');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['x', 'y', 'width', 'height', 'crystal', 'category']);
        });
    }
}
