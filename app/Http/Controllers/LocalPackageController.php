<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    LocalPackages,
    TimeSchadule,
};

class LocalPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['localpackage'] = LocalPackages::with('timeData')->orderBy('id', 'DESC')->get();
        return view('Admin.localPackage.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['timeSchadule'] = TimeSchadule::where('status', '1')->get();
        return view('Admin.localPackage.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required',
            'type' => 'required',
            'category' => 'required',
            'fair' => 'required',
            'extra_fair_perKm' => 'required',
            'extra_fair_perHour' => 'required',
            'driver_charge' => 'required',
            'night_charge' => 'required',
            'other_details' => 'required',
        ]);

        $add = LocalPackages::create([
            'time' => $request->time,
            'type' => $request->type,
            'category' => $request->category,
            'fair' => $request->fair,
            'extra_fair_perKm' => $request->extra_fair_perKm,
            'extra_fair_perHour' => $request->extra_fair_perHour,
            'driver_charge' => $request->driver_charge,
            'night_charge' => $request->night_charge,
            'other_details' => $request->other_details,
        ]);

        return redirect()->route('localpackage.index')->with('success', 'Data Added Successfully!');
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
        $data['timeSchadule'] = TimeSchadule::where('status', '1')->get();
        $data['localpackage'] = LocalPackages::where('id', $id)->first();
        return view('Admin.localPackage.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'time' => 'required',
            'type' => 'required',
            'category' => 'required',
            'fair' => 'required',
            'extra_fair_perKm' => 'required',
            'extra_fair_perHour' => 'required',
            'driver_charge' => 'required',
            'night_charge' => 'required',
            'other_details' => 'required',
        ]);

        $add = LocalPackages::where('id', $id)->update([
            'time' => $request->time,
            'type' => $request->type,
            'category' => $request->category,
            'fair' => $request->fair,
            'extra_fair_perKm' => $request->extra_fair_perKm,
            'extra_fair_perHour' => $request->extra_fair_perHour,
            'driver_charge' => $request->driver_charge,
            'night_charge' => $request->night_charge,
            'other_details' => $request->other_details,
        ]);

        return redirect()->route('localpackage.index')->with('success', 'Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
