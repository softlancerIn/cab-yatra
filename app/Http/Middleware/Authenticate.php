<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        \Log::info('RedirectTo invoked', [
            'expectsJson' => $request->expectsJson(),
            'path' => $request->path(),
        ]);
        if (! $request->expectsJson()) {
            $uri = $request->path();
            $prefix = explode("/", $uri)[0];
            if (($prefix == 'admin')) {
                return route('admin_login');
            }
            if ($prefix == 'vendor') {
                return route('vendor.login');
                // return redirect('/vendors/login');
            }


            // return route('web_login'); // Ensure this route is correctly named and exists
        }
    }
}
