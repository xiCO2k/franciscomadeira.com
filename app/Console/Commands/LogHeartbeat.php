<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LogHeartbeat extends Command
{
    protected $signature = 'dummy:heartbeat';

    protected $description = 'Log a heartbeat message';

    public function handle(): void
    {
        Log::info('Heartbeat: application is alive at '.now()->toDateTimeString());
    }
}
