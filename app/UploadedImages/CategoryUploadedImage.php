<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 10/7/15
 * Time: 10:05 PM
 */

namespace App\UploadedImages;


class CategoryUploadedImage extends UploadedImage {

    protected $basePath = '/images/adminuploads/categories/';

    protected $dimensions = [
        'thumb' => 350,
        'main' => 500
    ];

}