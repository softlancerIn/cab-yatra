<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CabAirportFair;
use App\Models\CarCategory;

class OnewayAndAirportFairController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'car_category' => 'required',
                'min_fair' => 'required',
                'min_distance' => 'required',
                'extra_fair_perKm' => 'required',
                'extra_fair_for_showing' => 'required',
                'off' => 'required',
                'type' => 'required',
                'other_details' => 'required'
            ]);

            $validated['min_fair'] = json_encode($validated['min_fair']);
            $validated['min_distance'] = json_encode($validated['min_distance']);
            // dump($request->id);
            // dd($validated);
            $add = CabAirportFair::updateOrCreate(
                [
                    'id' => $request->id,
                ],
                $validated
            );

            return redirect()->route('onewayAirportFairList')->with('success', 'Data Added Successfully');
        }
        $data['list'] = CabAirportFair::with('cabCategory')->orderBy('id', 'DESC')->get();

        foreach ($data['list'] as $key => $value) {

            if ($value->type == '1') {
                $value->type = 'One Way';
            } else {
                $value->type = 'Airport';
            }
        }

        return view('Admin.localAirportFair.index', compact('data'));
    }

    public function createEdit(Request $request, $id)
    {
        $data['CarCategory'] = CarCategory::where('status', '1')->orderBy('id', "DESC")->get();
        if ($id == 0) {
            return view('Admin.localAirportFair.create', compact('data'));
        }

        $data['CabAirportFair'] = CabAirportFair::where('id', $id)->first();
        return view('Admin.localAirportFair.edit', compact('data'));
    }
}
