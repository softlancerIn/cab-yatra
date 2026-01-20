<?php

namespace App\Http\Controllers;

use App\Services\CommonServices;
use Illuminate\Http\Request;
use App\Models\{
    CarCategory,
    Cars,
};

class CarController extends Controller
{
    public function __construct(public CommonServices $commonServices) {}
    public function index()
    {
        $data = [];
        $cars = Cars::with('carCat')->orderBy('id', 'DESC')->get();

        $data['cars'] = $cars;
        return view('Admin.car.index', compact('data'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('GET')) {
            $data['category'] = CarCategory::where('status', '1')->get();
            return view('Admin.car.add', compact('data'));
        } else {
            $validated = $request->validate([
                'name' => 'required',
                'type' => 'required',
                'category' => 'required',
                'min_charge' => 'required',
                'other_details' => 'required',
            ]);

            if ($request->has('id')) {
                if ($request->has('image') && !empty($request->image)) {
                    $image = $this->commonServices->fileupload($request->image, 'cars');
                    $update = Cars::where('id', $request->id)->update([
                        'image' => $image
                    ]);
                }
                $update = Cars::where('id', $request->id)->update([
                    'name' => $request->name,
                    'type' => $request->type,
                    'category' => $request->category,
                    'fuel_type' => $request->fuel_type,
                    'min_charge' => $request->min_charge ?? '',
                    'car_number' => $request->car_number ?? '',
                    'other_details' => $request->other_details ?? '',
                ]);

                $message = 'Data Upated Successfully!';
            } else {
                $unqid = mt_rand(1000000, 9999999);
                $validated = $request->validate([
                    'image' => 'required',
                ]);

                $image = $this->commonServices->fileupload($request->image, 'cars');
                $add = Cars::create([
                    'unique_number' => $unqid,
                    'name' => $request->name ?? '',
                    'type' => $request->type ?? '',
                    'category' => $request->category ?? '',
                    'fuel_type' => $request->fuel_type ?? '',
                    'image' => $image ?? '',
                    'min_charge' => $request->min_charge ?? '',
                    'car_number' => $request->car_number ?? '',
                    'other_details' => $request->other_details ?? '',
                ]);
                $message = 'Data Added Successfully!';
            }

            return redirect()->route('car_list')->with('success', $message);
        }
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['category'] = CarCategory::where('status', '1')->get();
        $data['edit'] = Cars::where('id', $id)->first();
        return view('Admin.car.edit', compact('data'));
    }
}
