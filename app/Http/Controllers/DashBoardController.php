<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Cars,
    Driver,
    cabBooking,
    TourPackages,
    DriverCarDetails,
    TourPackageBooking,
};
use Hash;

class DashBoardController extends Controller
{
    public function index()
    {
        // dd(Hash::make('cabyatra1234'));
        $data['total_car'] = cars::count();
        $data['total_driver'] = Driver::count();
        $data['total_cabBooking'] = cabBooking::count();
        $data['total_packages'] = TourPackages::count();
        $data['total_tourPackageBooking'] = TourPackageBooking::count();

        $data['pending'] = TourPackageBooking::where('status', '0')->count();
        $data['accepted'] = TourPackageBooking::where('status', '1')->count();
        $data['completed'] = TourPackageBooking::where('status', '2')->count();
        $data['reject'] = TourPackageBooking::where('status', '3')->count();

        $data['cab_pending'] = cabBooking::where('status', '0')->count();
        $data['cab_accepted'] = cabBooking::where('status', '1')->count();
        $data['cab_completed'] = cabBooking::where('status', '2')->count();
        $data['cab_reject'] = cabBooking::where('status', '3')->count();

        $data['list'] = cabBooking::with('carCategory')->where('status', '0')->orderBy('id', 'DESC')->get();
        return view('Admin.index', compact('data'));
    }
}
