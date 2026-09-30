<?php

use App\Jobs\ProcessHeartbeat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Schedule::command('dummy:quote')->everyFiveMinutes();

Schedule::call(function () {
    Log::info('Dummy cleanup: pretending to clear temp files at '.now()->toDateTimeString());
})->hourly()->name('dummy:cleanup');

// Dispatch a heartbeat to the managed queue every minute, to watch it stop when retired.
Schedule::call(function () {
    ProcessHeartbeat::dispatch(now()->toDateTimeString());

    Log::info('Queue heartbeat dispatched at '.now()->toDateTimeString());
})->everyMinute()->name('queue:heartbeat');
