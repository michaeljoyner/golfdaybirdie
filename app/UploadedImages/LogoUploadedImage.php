<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/15/15
 * Time: 9:59 AM
 */

namespace App\UploadedImages;


class LogoUploadedImage extends UploadedImage {

    protected $basePath = '/useruploads/logos/';

    protected $dimensions = [
        'thumb' => 150,
        'main' => 900
    ];

}