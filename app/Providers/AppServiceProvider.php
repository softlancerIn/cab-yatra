<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\AppBanner;
use App\Models\cabBooking;
use App\Models\AssignBooking;

use App\Observers\AppBannerObserver;
use App\Observers\CabBookingObserver;
use App\Observers\AssignBookingObserver;


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
        AppBanner::observe(AppBannerObserver::class);
        cabBooking::observe(CabBookingObserver::class);
        AssignBooking::observe(AssignBookingObserver::class);
        // dd(env('GOOGLE_MAPS_API_KEY'));
        \DB::statement("SET time_zone = '+00:00'");
    }
}
