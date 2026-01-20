<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Seo;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data['seo'] = Seo::where('page_url', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(20);
        } else {
            $data['seo'] = Seo::orderBy('id', 'DESC')->paginate(20);
        }

        // $data['seo'] = Seo::orderBy('id', 'DESC')->paginate(20);
        return view('Admin.seo.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.seo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_url' => 'required',
            'title' => 'required',
            'keyword' => 'required',
            'description' => 'required',
            'script' => 'required',
            'status' => 'required',
        ]);

        Seo::create($validated);
        return redirect()->route('seoData.index')->with('success', 'Data Added Successfully!');
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
        $data['edit'] = Seo::where('id', $id)->first();
        return view('Admin.seo.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'page_url' => 'required',
            'title' => 'required',
            'keyword' => 'required',
            'description' => 'required',
            'script' => 'required',
            'status' => 'required',
        ]);

        Seo::where('id', $id)->update($validated);
        return redirect()->route('seoData.index')->with('success', 'Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
