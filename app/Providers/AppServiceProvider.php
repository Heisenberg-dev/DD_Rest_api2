<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('boomchik', function (Request $request) {
            return Limit::perMinute(5)->by($request->user()?->id ?: $request->ip())
            ->response(function (Request $request, array $headers){
                return response()->json([
                    "message" => "you made too many attemps"
                ], 429);
                });
        });
    }
}
