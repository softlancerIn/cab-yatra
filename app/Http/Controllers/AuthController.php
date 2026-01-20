<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\{
    Admin,
};
use Auth;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        // dd(Hash::make('cabyatrabooking@@0987'));
        if (request()->isMethod('POST')) {
            $validated = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $admin = Admin::where('email', request()->email)->first();

            if (!empty($admin)) {
                $check_pass = Hash::check($request->password, $admin->password);
                if (!empty($check_pass)) {
                    Auth::guard('web_admin')->loginUsingId($admin->id);
                    return redirect()->route('dashboard')->with('success', 'Logged In Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Incorrect Password!');
                }
            } else {
                return redirect()->back()->with('error', 'Email Not Registered!');
            }
        } else {
            return view('Admin.Auth.login');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web_admin')->logout();
        return redirect('admin/login');
    }
}
