<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/15/15
 * Time: 10:25 AM
 */

namespace App\UploadedImages;


trait GetsImageSourcesTrait {

    public function getImagePathAttribute($image_path)
    {
        return $this->smallestImageSrc();
    }

    public function imageSrc()
    {
        if(! isset($this->attributes['image_path']) || $this->cantResolveImagePath($this->attributes['image_path'])) {
            return asset($this->fallbackImagePath);
        }

        return asset($this->attributes['image_path']);
    }

    public function smallestImageSrc()
    {
        $thumbPath = $this->getThumbPath($this->attributes['image_path']);

        if($this->cantResolveImagePath($thumbPath)) {
            return $this->imageSrc();
        }

        return asset($thumbPath);
    }

    public function originalImageSrc()
    {
        $originalPath = $this->getOriginalPath($this->attributes['image_path']);

        if($this->cantResolveImagePath($originalPath)) {
            return $this->imageSrc();
        }

        return asset($originalPath);
    }

    /**
     * @param $path
     * @return bool
     */
    private function cantResolveImagePath($path)
    {
        return !isset($path) || ($path === 'default.jpg') || empty($path) || ! file_exists(public_path().$path);
    }

    private function getThumbPath($image_path)
    {
        if(! $image_path) {
            return $image_path;
        }

        $pathParts = explode('/', $image_path);
        $filename = array_pop($pathParts);
        $thumbPath = implode('/', $pathParts).'/thumb/'.$filename;

        return $thumbPath;
    }

    private function getOriginalPath($image_path)
    {
        if(! $image_path) {
            return $image_path;
        }

        $pathParts = explode('/', $image_path);
        $filename = array_pop($pathParts);
        $originalPath = implode('/', $pathParts).'/original/'.$filename;

        return $originalPath;
    }

}