<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eventable_id');
            $table->string('eventable_type');
            $table->string('name')->nullable();
            $table->string('hosted_by')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('type')->nullable();
            $table->string('cost')->nullable();
            $table->timestamp('status')->nullable();
            $table->string('rate')->nullable();//hosting inclusive
            $table->string('gem')->nullable();
            $table->string('prizes')->nullable();
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
        Schema::dropIfExists('events');
    }
}
