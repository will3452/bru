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

            $table->foreignId('user_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('invoiceable_id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('proof_of_payment');

            $table->string('payment_for');

            $table->string('pay_with');

            $table->string('currency')->default('PHP');

            $table->string('amount');

            $table->string('invoiceable_type');

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
