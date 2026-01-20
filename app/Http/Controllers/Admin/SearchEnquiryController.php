<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CommonServices;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\SearchEnquiry;
use App\Models\FooterLink;

class SearchEnquiryController extends Controller
{
    public function __construct(public CommonServices $commonServices) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['searchEnquiry'] = SearchEnquiry::orderBy('id', 'DESC')->paginate(20);
        return view('Admin.search_enquiry.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['category'] = SearchEnquiry::where('status', '1')->get();
        return view('Admin.footer_link.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'footlnk_catId' => 'required',
            'pickup' => 'required',
            'destination' => 'required',
            'title' => 'required',
            'content' => 'required',
            'status' => 'required',
        ]);

        $slug = Str::slug($request->title, '-');

        $image = "";
        if ($request->has('image')) {
            $image = $this->commonServices->fileupload($request->file('image'), 'footer_image');
        }

        $add = FooterLink::create([
            'footlnk_catId' => $request->footlnk_catId ?? '',
            'pickup' => $request->pickup ?? '',
            'destination' => $request->destination ?? '',
            'url_name' => $request->title ?? '',
            'slug' => $slug ?? '',
            'image' => $image,
            'content' => $request->content ?? '',
            'status' => $request->status ?? '1',
        ]);

        return redirect()->route('footerLinks.index')->with('success', 'Data Added Successfully!');
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
        $data['footerLinkData'] = FooterLink::where('id', $id)->first();
        $data['category'] = SearchEnquiry::where('status', '1')->get();
        return view('Admin.footer_link.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'footlnk_catId' => 'required',
            'pickup' => 'required',
            'destination' => 'required',
            'title' => 'required',
            'content' => 'required',
            'status' => 'required',
        ]);

        $slug = Str::slug($request->title, '-');

        if ($request->has('image')) {
            $image = $this->commonServices->fileupload($request->file('image'), 'footer_image');
            $add = FooterLink::where('id', $id)->update([
                'image' => $image,
            ]);
        }

        $add = FooterLink::where('id', $id)->update([
            'footlnk_catId' => $request->footlnk_catId ?? '',
            'pickup' => $request->pickup ?? '',
            'destination' => $request->destination ?? '',
            'url_name' => $request->title ?? '',
            'slug' => $slug ?? '',
            'content' => $request->content ?? '',
            'status' => $request->status ?? '1',
        ]);

        return redirect()->route('footerLinks.index')->with('success', 'Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
