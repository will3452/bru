<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('complete_book')->default(0);
            $table->integer('bought_purple_gem')->default(0);
            $table->integer('complete_heirs_series')->default(0);
            $table->integer('share_to_social_media')->default(0);
            $table->integer('complete_spin_off')->default(0);
            $table->integer('log_on_days')->default(0);
            $table->integer('participate_author_event')->default(0);
            $table->integer('participate_bru_event')->default(0);
            $table->integer('rate_book')->default(0);
            $table->integer('review_book')->default(0);
            $table->integer('verify_account')->default(0);
            $table->integer('invite_friend')->default(0);
            $table->integer('upgrade_account')->default(0);
            $table->integer('provide_mobile_number')->default(0);

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
        Schema::dropIfExists('homework');
    }
}
