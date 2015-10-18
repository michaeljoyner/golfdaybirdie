<?php

namespace App\Http\Controllers\Admin;

use App\UploadedImages\CategoryUploadedImage;
use App\UploadedImages\ProductUploadedImage;
use App\UploadedImages\ProductVersionUploadedImage;
use App\UploadedImages\UploadedImage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxImageUploadsController extends Controller
{
    public function storeProductImage(Request $request, ProductUploadedImage $uploadedImage)
    {
        $savedImagePath = $this->getFinalPathOfImage($request, $uploadedImage);

        return response()->json($savedImagePath);
    }

    public function storeCategoryImage(Request $request, CategoryUploadedImage $uploadedImage)
    {
        $savedImagePath = $this->getFinalPathOfImage($request, $uploadedImage);

        return response()->json($savedImagePath);
    }

    public function storeVersionImage(Request $request, ProductVersionUploadedImage $uploadedImage)
    {
        $savedImagePath = $this->getFinalPathOfImage($request, $uploadedImage);

        return response()->json($savedImagePath);
    }

    private function getFinalPathOfImage($request, UploadedImage $uploadedImage)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png,bmp,gif'
        ]);

        $uploadedImage->make($request->file('file'))->save();

        return $uploadedImage->mainPath;

    }
}
