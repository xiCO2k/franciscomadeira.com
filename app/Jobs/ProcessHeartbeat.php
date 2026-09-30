<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

/**
 * A tiny job dispatched every minute to the managed queue, so we can see in the logs
 * exactly when the queue stops (and resumes) processing jobs.
 */
class ProcessHeartbeat implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $dispatchedAt)
    {
        //
    }

    public function handle(): void
    {
        Log::info("Queue heartbeat processed at {$this->dispatchedAt} -> ".now()->toDateTimeString());
    }
}
