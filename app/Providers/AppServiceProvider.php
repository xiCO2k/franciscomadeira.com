<?php

namespace App\Providers;

use App\Ssr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Ssr::register();
        Model::unguard();
    }
}
