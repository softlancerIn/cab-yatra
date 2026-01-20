<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FooterLinkCategory;

class FooterLinksCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            // $data['seo'] = Seo::where('page_url', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(20);
            $data['footer_linkCategory'] = FooterLinkCategory::where('name', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(20);
        } else {
            $data['footer_linkCategory'] = FooterLinkCategory::orderBy('id', 'DESC')->paginate(20);
        }

        return view('Admin.footer_link_category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        return view('Admin.footer_link_category.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $add = FooterLinkCategory::create([
            'name' => $request->name ?? '',
            'status' => $request->status ?? '1',
        ]);

        return redirect()->route('footerLink-category.index')->with('success', 'Data Added Successfully!');
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
        $data['footer_linkCategory'] = FooterLinkCategory::where('id', $id)->first();
        return view('Admin.footer_link_category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $add = FooterLinkCategory::where('id', $id)->update([
            'name' => $request->name ?? '',
            'status' => $request->status ?? '1',
        ]);

        return redirect()->route('footerLink-category.index')->with('success', 'Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
