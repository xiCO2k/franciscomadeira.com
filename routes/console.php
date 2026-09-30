<?php

use App\Jobs\ProcessHeartbeat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Schedule::command('dummy:quote')->everyFiveMinutes();

Schedule::call(function () {
    Log::info('Dummy cleanup: pretending to clear temp files at '.now()->toDateTimeString());
})->hourly()->name('dummy:cleanup');

// Send a heartbeat to the managed queue every minute, to watch it stop when retired.
// Every heartbeat logs "SENT" here and "PROCESSED" from the queue worker, with the same name.
Schedule::call(function () {
    $sentAt = now();

    ProcessHeartbeat::dispatch($sentAt->toDateTimeString())->onGroup('heartbeat');

    Log::info("[QUEUE HEARTBEAT {$sentAt->format('H:i')}] SENT to the managed queue.");
})->everyMinute()->name('queue:heartbeat');
