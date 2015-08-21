<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/14/15
 * Time: 11:43 PM
 */

namespace App\UploadedImages;


use Exception;
use Intervention\Image\ImageManager;

abstract class UploadedImage {

    protected $originalName;

    protected $image = null;
    protected $imageForThumb = null;
    protected $imageForResize = null;

    protected $prefix;

    protected $basePath = '/images/useruploads/';
    
    protected $makeThumbnail = true;

    public $thumbPath = null;

    public $mainPath = null;

    public $originalPath = null;
    
    protected $dimensions = [
        'thumb' => 150,
        'main' => 500
    ];
    /**
     * @var
     */
    protected $imager;

    public function __construct(ImageManager $imager)
    {
        $this->imager = $imager;
        $this->prefix = time();
    }

    public function make($image)
    {
        $this->originalName = $this->getUsableName($image->getClientOriginalName());
        $this->image = $this->imager->make($image);
        $this->imageForThumb = $this->imager->make($image);
        $this->imageForResize = $this->imager->make($image);


        return $this;
    }

    public function save()
    {
        if(! $this->image) {
            throw new Exception('No assigned image to save');
        }

        if($this->shouldMakeThumbnail()) {
            $this->createThumbnail();
        }

        $this->resizeMain();

        $this->saveOriginal();
    }

    protected function createThumbnail()
    {
        $path = $this->basePath.'thumb/'.$this->prefix.$this->originalName;
        $thumb = $this->imageForThumb->fit($this->dimensions['thumb']);
        $this->thumbPath = $path;
        $thumb->save(public_path().$path);
    }

    protected function resizeMain()
    {
        $path = $this->basePath.$this->prefix.$this->originalName;
        $main = $this->resizeWithAspectRation($this->imageForResize, $this->dimensions['main']);
        $main->save(public_path().$path);
        $this->mainPath = $path;
    }

    protected function saveOriginal()
    {
        $path = $this->basePath.'original/'.$this->prefix.$this->originalName;
        $main = $this->image->save(public_path().$path);
        $this->originalPath = $path;
    }

    protected function resizeWithAspectRation($image, $dimension)
    {
        $wideImage = $this->image->width() > $this->image->height() ? true : false;
        if($wideImage) {
            $resizedImage = $image->resize($dimension, null, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        } else {
            $resizedImage = $image->resize(null, $dimension, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        return $resizedImage;
    }

    protected function shouldMakeThumbnail()
    {
        return $this->makeThumbnail && ($this->image->width() > $this->dimensions['thumb'] || $this->image->height() > $this->dimensions['thumb']);
    }

    protected function shouldResize()
    {
        return ($this->image->width() > $this->dimensions['main'] || $this->image->height() > $this->dimensions['main']);
    }

    protected function getUsableName($originalName)
    {
        if(mb_strlen($originalName) > 40) {
            return mb_substr($originalName, -39);
        }

        return $originalName;
    }

}