<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_id');
            $table->foreignId('to_id')->nullable();
            $table->string('amount');
            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('to_name')->nullable();
            $table->string('status')->default('pending'); // pending , cleared
            $table->string('type'); // gcash, grab_pay or cash 
            $table->text('desc'); // description
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
        Schema::dropIfExists('invoices');
    }
}
