<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    TourPackageBooking,
};

class TourPackageBookingController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['list'] = TourPackageBooking::with('tourPackage')->orderBy('id', 'DESC')->get();
        return view('Admin.tourPackageBooking.index', compact('data'));
    }

    public function tourPkgDetail(Request $request, $id)
    {
        $data['details'] = TourPackageBooking::with('tourPackage')->where('id', $id)->first();
        return view('Admin.tourPackageBooking.view', compact('data'));
    }
}
