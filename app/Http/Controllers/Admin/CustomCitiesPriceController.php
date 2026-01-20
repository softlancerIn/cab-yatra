<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Services\CommonServices;
use Illuminate\Http\Request;

use App\Models\CarCategory;

use App\Models\CustomCitiesPrice;
use App\Models\CustomCitiesCarPrice;

class CustomCitiesPriceController extends Controller
{
    public function __construct(public CommonServices $commonServices) {}
    public function index(Request $request)
    {
        $query = CustomCitiesPrice::with('carCategory')->orderBy('id', 'DESC');

        // If the request has pickup_loc, filter by it
        if ($request->has('pickup_loc') && !empty($request->pickup_loc)) {
            $query->where('pickup_loc', 'like', '%' . $request->pickup_loc . '%');
        }

        $custom_cities = $query->get()->transform(function ($item) {
            $custom_carPriceCount = CustomCitiesCarPrice::where('custom_citiesId', $item->id)->count();
            $item->custom_carPriceCount = $custom_carPriceCount;
            return $item;
        });

        $data['custom_cities'] = $custom_cities;

        return view('Admin.custom_cities.index', compact('data'));
    }


    public function create(Request $request)
    {
        $data = [];
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'pickup_loc' => 'required',
                'destination_loc' => 'required',
                'type' => 'required',
            ]);

            try {
                $add = CustomCitiesPrice::create($validated);
            } catch (\Throwable $th) {
                dd($th);
                Log::info("Custom cities Insert Data error", $th->getMessage());
                return redirect()->back()->with('error', 'Something went wrong!');
            }

            return redirect()->route('customCities_list')->with('success', 'Data Addedd Successfully!');
        }

        $data['CarCategory'] = CarCategory::with('car')->where(['status' => '1'])->get();
        return view('Admin.custom_cities.create', compact('data'));
    }

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'pickup_loc' => 'required',
                'destination_loc' => 'required',
                'type' => 'required',
            ]);

            try {
                $add = CustomCitiesPrice::updateOrCreate(
                    [
                        'id' => $id
                    ],
                    $validated
                );
            } catch (\Throwable $th) {
                dd($th);
                Log::info("Custom cities Insert Data error", $th->getMessage());
                return redirect()->back()->with('error', 'Something went wrong!');
            }
            return redirect()->route('customCities_list')->with('success', 'Data Updated Successfully!');
        }
        $data['edit'] = CustomCitiesPrice::where('id', $id)->first();
        return view('Admin.custom_cities.edit', compact('data'));
    }

    public function customCarCategoryPriceList(Request $request, $id)
    {
        $data['custom_cities'] = CustomCitiesPrice::with('carCategory')->where('id', $id)->first();
        $data['custom_carPrice'] = CustomCitiesCarPrice::with(['carCategory', 'customCities'])->where('custom_citiesId', $id)->get();
        $data['id'] = $id;
        return view('Admin.custom_cities.custom_car_price.index', compact('data'));
    }

    public function customCarCategoryPricecreate(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'total_km' => 'required',
                'fixed_fair' => 'required',
            ]);

            $validated['custom_citiesId'] = $id;
            $validated['car_categoryId'] = $request->car_categoryId;

            try {
                CustomCitiesCarPrice::create($validated);
            } catch (\Throwable $th) {
                Log::info("Custom cities car price Insert Data error", $th->getMessage());
                return redirect()->back()->with('error', 'Something went wrong!');
            }

            return redirect()->route('customCarCategoryPriceList', ['id' => $id])->with('success', 'Data Added Successfully!');
        }
        $data['id'] = $id;
        $data['custom_cities'] = CustomCitiesPrice::with('carCategory')->where('id', $id)->first();
        $data['car_category'] = CarCategory::where(['status' => '1'])->get();
        return view('Admin.custom_cities.custom_car_price.add', compact('data'));
    }

    public function customCarCategoryPriceEdit(Request $request, $id, $customCitiesCarPriceId)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'total_km' => 'required',
                'fixed_fair' => 'required',
            ]);

            $validated['custom_citiesId'] = $id;
            $validated['car_categoryId'] = $request->car_categoryId;

            try {
                CustomCitiesCarPrice::where('id', $customCitiesCarPriceId)->update($validated);
            } catch (\Throwable $th) {
                Log::info("Custom cities car price Insert Data error", $th->getMessage());
                return redirect()->back()->with('error', 'Something went wrong!');
            }

            return redirect()->route('customCarCategoryPriceList', ['id' => $id])->with('success', 'Data Updated Successfully!');
        }
        $data['id'] = $id;
        $data['CustomCitiesCarPriceData'] = CustomCitiesCarPrice::where('id', $customCitiesCarPriceId)->first();
        $data['custom_cities'] = CustomCitiesPrice::with('carCategory')->where('id', $id)->first();
        $data['car_category'] = CarCategory::where(['status' => '1'])->get();
        return view('Admin.custom_cities.custom_car_price.edit', compact('data'));
    }
}
