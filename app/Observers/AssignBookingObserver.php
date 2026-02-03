<?php

namespace App\Observers;

use App\Models\AssignBooking;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AssignBookingObserver
{
    public function created(AssignBooking $assign)
    {
        Log::info('AssignBooking created', [
            'driver_id' => $assign->driver_id
        ]);

        Cache::tags(['home'])->flush();
        Cache::tags(['driver_' . $assign->driver_id])->flush();
    }

    public function updated(AssignBooking $assign)
    {
        Log::info('AssignBooking updated', [
            'driver_id' => $assign->driver_id
        ]);

        Cache::tags(['driver_' . $assign->driver_id])->flush();
    }

    public function deleted(AssignBooking $assign)
    {
        Log::info('AssignBooking deleted', [
            'driver_id' => $assign->driver_id
        ]);

        Cache::tags(['driver_' . $assign->driver_id])->flush();
    }
}
