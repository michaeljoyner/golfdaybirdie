<?php

namespace App\Http\Controllers;

use App\UploadedImages\LogoUploadedImage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LogoUploadController extends Controller
{
    public function storeLogo(Request $request, LogoUploadedImage $image)
    {
        if(! $request->ajax()) {
            return response('Invalid request', 403);
        }

        $image->make($request->file('file'))->save();

        return response()->json($image->mainPath);
    }
}
