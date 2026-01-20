<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CommonServices;
use App\Models\{
    Driver,
    CarCategory,
    AssignBooking,
    DriverCarDetails,
};
use Illuminate\Support\Str;

class DriverController extends Controller
{
    public function __construct(public CommonServices $commonServices) {}
    public function index()
    {
        $data['list'] = Driver::with('DriverCarDetails')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.driver.index', compact('data'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'aadhar_no' => 'required',
                'pan_no' => 'required',
                'dl_no' => 'required',
                'driver_photo' => 'required',
                'aadhar_front_image' => 'required',
                'aadhar_back_image' => 'required',
                'dl_image' => 'required',
                'car_name' => 'required',
                'car_brand' => 'required',
                'car_image' => 'required',
                'car_no' => 'required',
                'fuel_type' => 'required',
                'no_ofSeat' => 'required',
                'expiry_date' => 'required',
                'insurence_photo' => 'required',
                'carRc_front_image' => 'required',
                'carRc_back_image' => 'required',
            ]);

            $uniqId = rand('10000', '99999');

            if ($request->has('driver_photo')) {
                $driver_photo = $this->commonServices->fileupload($request->driver_photo, 'driver_photo');
            }
            if ($request->has('aadhar_front_image') && $request->has('aadhar_back_image')) {
                $aadhar_front_image = $this->commonServices->fileupload($request->aadhar_front_image, 'aadhar_front_image');
                $aadhar_back_image = $this->commonServices->fileupload($request->aadhar_back_image, 'aadhar_back_image');
            }
            if ($request->has('dl_image')) {
                $dl_image = $this->commonServices->fileupload($request->dl_image, 'dl_image');
            }
            if ($request->has('insurence_photo')) {
                $insurence_photo = $this->commonServices->fileupload($request->insurence_photo, 'insurence_photo');
            }
            if ($request->has('carRc_front_image') && $request->has('carRc_back_image')) {
                $carRc_front_image = $this->commonServices->fileupload($request->carRc_front_image, 'carRc_front_image');
                $carRc_back_image = $this->commonServices->fileupload($request->carRc_back_image, 'carRc_back_image');
            }
            if ($request->has('car_image')) {
                $car_image = $this->commonServices->fileupload($request->car_image, 'car_image');
            }


            $add = Driver::create([
                'uniqId' => '#DRIVERID' . $uniqId,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'aadhar_no' => $request->aadhar_no,
                'pan_no' => $request->pan_no,
                'dl_no' => $request->dl_no,
                'driver_image' => $driver_photo,
                'aadhar_frontImage' => $aadhar_front_image ?? '',
                'aadhar_backImage' => $aadhar_back_image ?? '',
                'dl_image' => $dl_image ?? '',
            ]);

            $add = DriverCarDetails::create([
                'driver_id' => $add->id,
                'car_brand' => $request->car_brand,
                'car_name' => $request->car_name,
                'car_no' => $request->car_no,
                'fuel_type' => $request->fuel_type,
                'no_seat' => $request->no_ofSeat,
                'car_image' => $car_image,
                'insurence_image' => $insurence_photo ?? '',
                'insurence_expiry' => $request->expiry_date,
                'car_rc_frontImage' => $carRc_front_image,
                'car_rc_backImage' => $carRc_back_image,
            ]);

            return redirect()->route('driverList')->with('success', 'Data Added Successfully!');
        }
        return view('Admin.driver.add');
    }

    public function edit($id)
    {
        $data['edit'] = Driver::with('DriverCarDetails')->where('id', $id)->first();
        // $car = CarCategory::where('id',$data['edit']->)
        return view('Admin.driver.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'aadhar_no' => 'required',
            'pan_no' => 'required',
            'dl_no' => 'required',
            'car_name' => 'required',
            'car_brand' => 'required',
            'car_no' => 'required',
            'fuel_type' => 'required',
            'no_ofSeat' => 'required',
            'expiry_date' => 'required',
        ]);

        $uniqId = rand('10000', '99999');

        if ($request->has('driver_photo')) {
            $driver_photo = $this->commonServices->fileupload($request->driver_photo, 'driver_photo');
            $update = Driver::where('id', $request->id)->update([
                'driver_image' => $driver_photo,
            ]);
        }
        if ($request->has('aadhar_front_image') && $request->has('aadhar_back_image')) {
            $aadhar_front_image = $this->commonServices->fileupload($request->aadhar_front_image, 'aadhar_front_image');
            $aadhar_back_image = $this->commonServices->fileupload($request->aadhar_back_image, 'aadhar_back_image');

            $update = Driver::where('id', $request->id)->update([
                'aadhar_frontImage' => $aadhar_front_image ?? '',
                'aadhar_backImage' => $aadhar_back_image ?? '',
            ]);
        }
        if ($request->has('dl_image')) {
            $dl_image = $this->commonServices->fileupload($request->dl_image, 'dl_image');
            $update = Driver::where('id', $request->id)->update([
                'dl_image' => $dl_image ?? '',
            ]);
        }
        if ($request->has('insurence_photo')) {
            $insurence_photo = $this->commonServices->fileupload($request->insurence_photo, 'insurence_photo');
            $update = DriverCarDetails::where('driver_id', $request->id)->update([
                'insurence_image' => $insurence_photo ?? '',
            ]);
        }
        if ($request->has('carRc_front_image') && $request->has('carRc_back_image')) {
            $carRc_front_image = $this->commonServices->fileupload($request->carRc_front_image, 'carRc_front_image');
            $carRc_back_image = $this->commonServices->fileupload($request->carRc_back_image, 'carRc_back_image');

            $update = DriverCarDetails::where('driver_id', $request->id)->update([
                'car_rc_frontImage' => $carRc_front_image,
                'car_rc_backImage' => $carRc_back_image,
            ]);
        }
        if ($request->has('car_image')) {
            $car_image = $this->commonServices->fileupload($request->car_image, 'car_image');

            $update = DriverCarDetails::where('driver_id', $request->id)->update([
                'car_image' => $car_image,
            ]);
        }


        $update = Driver::where('id', $request->id)->update([
            // 'uniqId' => '#DRIVERID' . $uniqId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'aadhar_no' => $request->aadhar_no,
            'pan_no' => $request->pan_no,
            'dl_no' => $request->dl_no,
        ]);

        $update = DriverCarDetails::where('driver_id', $request->id)->update([
            'car_brand' => $request->car_brand,
            'car_name' => $request->car_name,
            'car_no' => $request->car_no,
            'fuel_type' => $request->fuel_type,
            'no_seat' => $request->no_ofSeat,
            'insurence_expiry' => $request->expiry_date,
        ]);

        return redirect()->route('driverList')->with('success', 'Data Updated Successfully!');
    }

    public function changeStatus(Request $request, $type)
    {
        if ($type == 'is_verified') {
            $update = Driver::where('id', $request->id)->update([
                'is_verified' => $request->is_verified,
            ]);
        }

        if ($type == 'is_registered') {
            $update = Driver::where('id', $request->id)->update([
                'is_registered' => $request->is_registered,
            ]);
        }

        if ($type == 'status') {
            $update = Driver::where('id', $request->id)->update([
                'status' => $request->status,
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Data Updated Successfully!']);
    }

    public function driverOrders(Request $request, $driverID)
    {
        if ($request->isMethod('POST')) {
            //
        }

        $data['orders'] = AssignBooking::with('bookingData')->where('driver_id', $driverID)->orderBy('id', 'DESC')->get();
        foreach ($data['orders'] as $ord) {
            $carCategory = CarCategory::where('id', $ord->bookingData->carCategory_id)->first();
            $ord->carCategory = $carCategory;
        }
        return view('Admin.driver.orders', compact('data'));
    }
}
