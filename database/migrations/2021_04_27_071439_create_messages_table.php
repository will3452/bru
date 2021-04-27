<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receiver_id')->nullable();
            $table->foreignId('sender_id')->nullable();
            $table->foreignId('admin_receiver_id')->nullable();
            $table->foreignId('admin_sender_id')->nullable();
            $table->string('type')->nullable();
            $table->string('subject')->nullable();
            $table->string('character')->nullable(); // for admin only
            $table->text('body');
            $table->foreignId('reply_id')->nullable();
            $table->string('replyable')->nullable(); // is replyable? 
            $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
