<?php

namespace Fabfoto\GalleryBundle\Uploader;

interface ImageInterface
{

     public function getWebPath();

    public function getThumbPath();

    public function getAbsoluteThumbPath();

    public function getAbsolutePath();

    public function getFilterPath();

    public function removeUpload();
}
