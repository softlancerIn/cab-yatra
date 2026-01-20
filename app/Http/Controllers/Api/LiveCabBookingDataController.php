<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    cabBooking,
};

class LiveCabBookingDataController extends Controller
{
    public function getLiveBooking(Request $request)
    {
        $response = new StreamedResponse(function () {
            while (true) {
                // Fetch your live data (e.g., assigned bookings)
                $liveData = cabBooking::where('is_assigned', '1')->latest()->get(['id', 'orderId', 'type', 'subType', 'is_airpotToFrom', 'address', 'pickUpLoc', 'destinationLoc', 'pickUp_time']);

                // Send the data as a JSON-encoded string
                echo json_encode(['success' => true, 'data' => $liveData]) . "\n\n";

                // Flush the output buffer to send data immediately
                ob_flush();
                flush();

                // Wait for 5 seconds before the next update
                sleep(20);
            }
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');

        return $response;
    }
}
