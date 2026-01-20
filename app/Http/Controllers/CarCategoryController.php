<?php

namespace App\Http\Controllers;

use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['carCategory'] = CarCategory::orderBy('id', 'DESC')->get();
        return view('Admin.carCategory.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.carCategory.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'per_km_cost' => 'required',
            'extra_fair_perKm' => 'required',
            'extra_fair_perHour' => 'required',
            'fuel_charge' => 'required',
            'driver_charge' => 'required',
            'night_charge' => 'required',
            'other_details' => 'required',
            'off' => 'required',
        ]);

        $validated['toll'] = $request->toll ?? null;
        $validated['tax'] = $request->tax ?? null;
        $validated['parking'] = $request->toll ?? null;

        $add = CarCategory::create($validated);

        return redirect()->route('carCategory.index')->with('success', 'Data Added Successfully!');
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
        $data['categryData'] = CarCategory::where('id', $id)->first();
        return view('Admin.carCategory.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'per_km_cost' => 'required',
            'extra_fair_perKm' => 'required',
            'extra_fair_perHour' => 'required',
            'other_details' => 'required',
        ]);

        $validated['toll'] = $request->toll ?? null;
        $validated['tax'] = $request->tax ?? null;
        $validated['parking'] = $request->toll ?? null;
        $optionalFields = $request->only(['fuel_charge', 'driver_charge', 'night_charge', 'off']);

        $dataToUpdate = array_merge($validated, $optionalFields);
        $add = CarCategory::where('id', $id)->update($dataToUpdate);

        return redirect()->route('carCategory.index')->with('success', 'Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
