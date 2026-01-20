<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeSchadule;
use App\Models\CarCategory;

use App\Models\Time;

class TimeSchaduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['timeschadule'] = TimeSchadule::with('timeData')->orderBy('id', 'DESC')->get();
        foreach ($data['timeschadule'] as $key => $value) {
            if (!empty($value->car_category)) {
                $carCategory = CarCategory::where('id', $value->car_category)->first();
                $value->car_category = $carCategory->name;
            }
        }
        // dd($data);
        return view('Admin.timeschadule.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['carCategory'] = CarCategory::where('status', '1')->get();
        $data['time'] = Time::where('status', '1')->get();
        return view('Admin.timeschadule.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_category' => 'required',
            'time_id' => 'required',
            'fair' => 'required',
            'extra_fair_perHour' => 'required',
            'extra_fair_perKm' => 'required',
            'other_details' => 'required',
            'off' => 'required',
        ]);

        $add = TimeSchadule::create([
            'car_category' => $request->car_category,
            'time_id' => $request->time_id,
            'fair' => $request->fair,
            'extra_fair_perHour' => $request->extra_fair_perHour,
            'extra_fair_perKm' => $request->extra_fair_perKm,
            'off' => $request->off,
            'other_details' => $request->other_details,
        ]);

        return redirect()->route('timeschadule.index')->with('success', 'Data Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [];
        $data['carCategory'] = CarCategory::where('status', '1')->get();
        $data['edit'] = TimeSchadule::where('id', $id)->first();
        $data['time'] = Time::where('status', '1')->get();
        return view('Admin.timeschadule.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'car_category' => 'required',
            'time_id' => 'required',
            'fair' => 'required',
            'extra_fair_perHour' => 'required',
            'extra_fair_perKm' => 'required',
            'status' => 'required',
            'off' => 'required',
            'other_details' => 'required',
        ]);

        $add = TimeSchadule::where('id', $id)->update([
            'car_category' => $request->car_category,
            'time_id' => $request->time_id,
            'fair' => $request->fair,
            'extra_fair_perHour' => $request->extra_fair_perHour,
            'extra_fair_perKm' => $request->extra_fair_perKm,
            'status' => $request->status,
            'off' => $request->off,
            'other_details' => $request->other_details,
        ]);

        return redirect()->route('timeschadule.index')->with('success', 'Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
