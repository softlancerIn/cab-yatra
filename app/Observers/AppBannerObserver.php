<?php

namespace App\Observers;

use App\Models\AppBanner;
use Illuminate\Support\Facades\Cache;

class AppBannerObserver
{
    public function created(AppBanner $banner)
    {
        Cache::tags(['home'])->flush();
    }

    public function updated(AppBanner $banner)
    {
        Cache::tags(['home'])->flush();
    }

    public function deleted(AppBanner $banner)
    {
        Cache::tags(['home'])->flush();
    }
}
