<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outboxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('outboxable_id');
            $table->string('outboxable_type');
            $table->unsignedBigInteger('to_id')->nullable();
            $table->string('desc')->nullable();
            $table->unsignedBigInteger('reply_to')->nullable();
            $table->text('subject')->nullable();
            $table->longText('message')->nullable();
            $table->string('character_sender')->nullable();
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
        Schema::dropIfExists('outboxes');
    }
}
