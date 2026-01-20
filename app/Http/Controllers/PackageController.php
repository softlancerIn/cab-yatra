<?php

namespace App\Http\Controllers;

use App\Services\CommonServices;
use Illuminate\Http\Request;
use App\Models\{
    Cars,
    Packages,
    CarCategory,
    AssignCarToPackage,
};
use Illuminate\Support\Facades\Redirect;

class PackageController extends Controller
{
    public function __construct(public CommonServices $commonServices) {}

    public function index(Request $request)
    {
        $data = [];
        $data['package'] = Packages::orderBy('id', 'DESC')->paginate(10);
        return view('Admin.package.index', compact('data'));
    }

    public function create(Request $request)
    {
        $data = [];
        if ($request->isMethod('GET')) {
            $data['car'] = Cars::where('status', '1')->get();
            $data['carCategory'] = CarCategory::where('status', '1')->get();
            return view('Admin.package.add', compact('data'));
        } else {
            $validated = $request->validate([
                'name' => 'required',
                'to' => 'required',
                'category_id' => 'required',
                'image' => 'required',
                'from' => 'required',
                'per_km_cost' => 'required',
                'total_price' => 'required',
                'distance' => 'required',
                'other_details' => 'required',
            ]);

            if ($request->has('image') && !empty($request->image)) {
                $image = $this->commonServices->fileupload($request->image, 'packages');
                if ($request->has('id')) {
                    $update = Packages::where('id', $request->id)->update([
                        'image' => $image,
                    ]);
                }
            }

            if ($request->has('id')) {
                $update = Packages::where('id', $request->id)->update([
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                    'to' => $request->to ?? '',
                    'from' => $request->from ?? '',
                    'per_km_cost' => $request->per_km_cost ?? '',
                    'total_price' => $request->total_price ?? '',
                    'distance' => $request->distance ?? '',
                    'other_details' => $request->other_details ?? '',
                    'night_charge' => $request->night_charge ?? '',
                    'air_type' => $request->air_type ?? '',
                    'extra_fair_perKm' => $request->extra_fair_perKm ?? '',
                    'driver_charge' => $request->driver_charge ?? '',
                ]);
            } else {
                $add = Packages::create([
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                    'to' => $request->to,
                    'image' => $image,
                    'from' => $request->from ?? '',
                    'per_km_cost' => $request->per_km_cost ?? '',
                    'total_price' => $request->total_price ?? '',
                    'distance' => $request->distance ?? '',
                    'other_details' => $request->other_details ?? '',
                    'night_charge' => $request->night_charge ?? '',
                    'air_type' => $request->air_type ?? '',
                    'extra_fair_perKm' => $request->extra_fair_perKm ?? '',
                    'driver_charge' => $request->driver_charge ?? '',
                ]);
            }

            if ($request->has('id')) {
                $message = 'Data Upated Successfully!';
            } else {
                $message = 'Data Added Successfully!';
            }

            return redirect()->route('packages')->with('success', $message);
        }
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['car'] = Cars::where('status', '1')->get();
        $data['package'] = Packages::where('id', $id)->first();
        return view('Admin.package.edit', compact('data'));
    }


    //============================ Assgn Car Function ==============================//
    public function assignCar($packageId)
    {
        $data = [];
        $data['package_data'] = Packages::where('id', $packageId)->first();
        $data['car_list'] = AssignCarToPackage::with('carData')->where('package_id', $packageId)->orderBy('id', 'DESC')->get();
        // dd($data['car_list']);

        return view('Admin.package.assignCar.index', compact('data'));
    }
    public function addAssignCar(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required',
            'package_id' => 'required',
        ]);

        $add = AssignCarToPackage::create([
            'car_id' => $request->car_id,
            'package_id' => $request->package_id,
        ]);

        return redirect()->back()->with('success', 'Car Assigned Successfully!');
    }
}
