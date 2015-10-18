<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 10/9/15
 * Time: 10:42 AM
 */

namespace App\UploadedImages;


class ProductVersionUploadedImage extends UploadedImage {

    protected $basePath = '/images/adminuploads/versions/';

    protected $dimensions = [
        'thumb' => 120,
        'main' => 500
    ];

}