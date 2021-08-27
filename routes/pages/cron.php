<?php

Route::prefix('cron')->group(function () {

    Route::get('message-clear', 'CronController@deleteAllMessage');

});
