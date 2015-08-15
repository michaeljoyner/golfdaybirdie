<?php

namespace App\Http\Controllers\Admin;

use App\UploadedImages\ProductUploadedImage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxImageUploadsController extends Controller
{
    public function store(Request $request, ProductUploadedImage $uploadedImage)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png,bmp,gif'
        ]);

        $uploadedImage->make($request->file('file'))->save();

        return response()->json($uploadedImage->mainPath);
    }
}
