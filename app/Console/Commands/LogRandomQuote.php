<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LogRandomQuote extends Command
{
    protected $signature = 'dummy:quote';

    protected $description = 'Log a random quote';

    public function handle(): void
    {
        $quotes = [
            'The only way to do great work is to love what you do.',
            'Stay hungry, stay foolish.',
            'Simplicity is the ultimate sophistication.',
        ];

        Log::info('Quote of the moment: '.$quotes[array_rand($quotes)]);
    }
}
