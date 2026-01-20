<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Time;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['time'] = Time::orderBy('id', 'DESC')->get();
        return view('Admin.time.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.time.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required',
            'status' => 'required',
        ]);

        try {
            $add = Time::create([
                'time' => $request->time,
                'status' => $request->status,
            ]);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
        return redirect()->route('time.index')->with('success', 'Time Data Added Successfully!');
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
        $data['edit'] = Time::where('id', $id)->first();
        return view('Admin.time.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'time' => 'required',
            'status' => 'required',
        ]);

        $add = Time::where('id', $id)->update([
            'time' => $request->time,
            'status' => $request->status,
        ]);
        return redirect()->route('time.index')->with('success', 'Time Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
