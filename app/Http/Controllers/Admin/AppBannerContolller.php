<?php

namespace App\Http\Controllers\Admin;

use App\Services\CommonServices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AppBanner;

class AppBannerContolller extends Controller
{

    public function __construct(public CommonServices $commonServices) {}
    public function index()
    {
        $data['app_banner'] = AppBanner::orderBy('id', 'DESC')->paginate(10);
        return view("Admin.banner.index", compact('data'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'name' => 'required',
                'url' => 'required',
                'image' => 'required',
            ]);

            if ($request->has('image')) {
                $image = $this->commonServices->fileupload($request->image, 'app_banner');
            }

            $add = AppBanner::create([
                'name' => $request->name ?? '',
                'image' => $image ?? '',
                'url' => $request->url ?? '',
                'status' => $request->status,
            ]);

            return redirect()->route('banner_list')->with('success', 'Data Added Successfully!');
        }
    }

    public function edit(Request $request)
    {
        $edit = AppBanner::where('id', $request->id)->first();
        return response()->json(['status' => true, 'data' => $edit]);
    }

    public function update(Request $request)
    {
        if ($request->has('image')) {
            $image = $this->commonServices->fileupload($request->image, 'app_banner');
            $update = AppBanner::where('id', $request->id)->update([
                'image' => $image,
            ]);
        }

        $update = AppBanner::where('id', $request->id)->update([
            'name' => $request->name,
            'url' => $request->url ?? '',
            'status' => $request->status,
        ]);

        return redirect()->route('banner_list')->with('success', 'Data Upated Successfully!');
    }
}
