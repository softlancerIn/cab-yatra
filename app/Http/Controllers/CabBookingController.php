<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    cabBooking,
    CarCategory,
};

class CabBookingController extends Controller
{
    public function index()
    {
        $data['list'] = cabBooking::with('carCategory')->orderBy('id', 'DESC')->get();
        return view('Admin.cabBooking.index', compact('data'));
    }

    public function cabBooingDetail(Request $request, $id)
    {
        $data = [];
        $data['details'] = cabBooking::with(['carCategory', 'driver'])->where('id', $id)->first();

        if ($data['details']->is_driver_createBooking == 1) {
            $data['details']->total_faire = $data['details']->offline_amount + $data['details']->driver_comission;
            $data['details']->offline_amount = $data['details']->offline_amount + $data['details']->driver_comission;
        }

        return view('Admin.cabBooking.view', compact('data'));
    }

    public function assign_cabBooking(Request $request)
    {
        $update = CabBooking::where('id', $request->cabBooking_id)->update([
            'driver_comission' => $request->driver_comission,
            'remark' => $request->remark,
            'is_assigned' => '1',
        ]);

        return redirect()->back()->with('success', 'Booking Assigned Successfully!');
    }
}
