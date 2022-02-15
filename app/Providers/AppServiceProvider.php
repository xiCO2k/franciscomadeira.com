<?php

namespace App\Providers;

use App\Ssr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Ssr::register();
        Model::unguard();

        Blade::if('vitedev', function () {
            if (app()->environment('production')) {
                return false;
            }

            try {
                Http::get('http://localhost:3000');
            } catch (ConnectionException $e) {
                return false;
            }

            return true;
        });
    }
}
