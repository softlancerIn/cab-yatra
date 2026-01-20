<?php

namespace App\Services;

class CommonServices
{
    //====================== image Upload ======================//
    public function fileupload($file, $type)
    {
        $path = public_path('/uploads/') . $type;
        if (file_exists($path)) {
            $filename = time() . '-' . $type . '-' . $file->getClientOriginalName();
            $file->move($path, $filename);
            return $filename;
        } else {
            mkdir($path, 0777, true);
            $filename = time() . '-' . $type . '-' . $file->getClientOriginalName();
            $file->move($path, $filename);
            return $filename;
        }
    }
    //====================== image Upload ======================//
}
