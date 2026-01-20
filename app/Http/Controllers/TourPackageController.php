<?php

namespace App\Http\Controllers;

use App\Services\CommonServices;
use Illuminate\Http\Request;
use App\Models\{
    TourPackages,
    City
};

class TourPackageController extends Controller
{
    public function __construct(public CommonServices $commonServices) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tour_package'] = TourPackages::orderBy('id', 'DESC')->paginate(10);
        return view('Admin.tour_packages.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['city'] = City::where('status', '1')->get();
        return view('Admin.tour_packages.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'image' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'city_id' => 'required',
            'tour_details' => 'required',
            'include_detail' => 'required',
            'excluded_detail' => 'required',
            'term_condition' => 'required',
        ]);

        if ($request->has('image') && !empty($request->image)) {
            $image = $this->commonServices->fileupload($request->image, 'tour_package');
            $validated['image'] = $image;
        }

        $add = TourPackages::create($validated);
        return redirect()->route('tourPackages.index')->with('success', 'Data Added Successfully!');
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
        $data['city'] = City::where('status', '1')->get();
        $data['tourPackage'] = TourPackages::where('id', $id)->first();
        return view('Admin.tour_packages.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'city_id' => 'required',
            'tour_details' => 'required',
            'include_detail' => 'required',
            'excluded_detail' => 'required',
            'term_condition' => 'required',
        ]);

        if ($request->has('image') && !empty($request->image)) {
            $validated = $request->validate([
                'image' => 'required',
            ]);
            $image = $this->commonServices->fileupload($request->image, 'tour_package');
            $validated['image'] = $image;
        }

        $update = TourPackages::where('id', $id)->update($validated);
        return redirect()->route('tourPackages.index')->with('success', 'Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
