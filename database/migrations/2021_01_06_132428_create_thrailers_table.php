<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThrailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thrailers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->text('video')->nullable();
            $table->string('code')->nullable();
            $table->string('approved')->nullable();
            $table->string('preview')->nullable();
            $table->string('proview_cost')->nullable();
            $table->string('cover')->nullable();
            $table->string('genre')->nullable();
            $table->string('book_id')->nullable();
            $table->string('thrailer_id')->nullable();
            $table->string('description')->nullable();
            $table->string('category')->nullable();
            $table->string('credit')->nullable();
            $table->string('age_restriction')->nullable();
            $table->string('language')->nullable();
            $table->string('gem')->nullable();
            $table->softDeletes();
            $table->string('cost')->nullable();
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
        Schema::dropIfExists('thrailers');
    }
}
