<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->string('title')->default('Untitled');
            $table->string('slug');
            $table->string('cost');//chapter cost
            $table->string('sq'); // to order
            $table->string('mode')->default('chapter'); //prolouge, epiloque or chapter
            $table->longText('content')->nullable();
            $table->string('type')->nullable();
            $table->text('art')->nullable();
            $table->string('art_cost')->nullable();
            $table->timestamp('cpy')->nullable();
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
        Schema::dropIfExists('chapters');
    }
}
