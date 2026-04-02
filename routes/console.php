<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Schedule::command('dummy:heartbeat')->everyMinute();
Schedule::command('dummy:quote')->everyFiveMinutes();

Schedule::call(function () {
    Log::info('Dummy cleanup: pretending to clear temp files at '.now()->toDateTimeString());
})->hourly()->name('dummy:cleanup');
