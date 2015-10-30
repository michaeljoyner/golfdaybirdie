<?php

namespace App\Http\Controllers;

use App\UploadedImages\LogoUploadedImage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LogoUploadsController extends Controller
{
    public function store(Request $request, LogoUploadedImage $uploadedImage)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png,bmp,gif'
        ]);

        $uploadedImage->make($request->file('file'))->save();

        return $uploadedImage->mainPath;
    }
}
