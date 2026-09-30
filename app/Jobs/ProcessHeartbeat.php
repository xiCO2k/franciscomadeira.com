<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * A tiny job sent to the managed queue every minute. Each heartbeat logs a SENT line
 * (from the scheduler) and a PROCESSED line (from the managed queue worker), so it is
 * easy to see when the queue stops (and resumes) processing jobs.
 */
class ProcessHeartbeat implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $sentAt)
    {
        //
    }

    public function handle(): void
    {
        $sentAt = Carbon::parse($this->sentAt);
        $name = $sentAt->format('H:i');
        $waited = (int) $sentAt->diffInSeconds(now());

        Log::info("[QUEUE HEARTBEAT {$name}] PROCESSED by the managed queue worker, {$waited}s after it was sent.");
    }
}
