<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractImage
 *
 * @author garciaf
 */
namespace Fabfoto\GalleryBundle\Uploader;

abstract class AbstractImage implements ImageInterface
{
    public function getWebPath()
    {
        return null === $this->getLocation() ? null : '/'.$this->getUploadDir() . '/' . $this->getLocation();
    }

    public function getThumbPath()
    {
        return null === $this->getLocation() ? null : $this->getUploadDir() . '/mini' . $this->getLocation();
    }

    public function getAbsoluteThumbPath()
    {
        return null === $this->getLocation() ? null : $this->getUploadRootDir() . '/mini' . $this->getLocation();
    }

    public function getAbsolutePath()
    {
        return null === $this->getLocation() ? null : $this->getUploadRootDir() . '/' . $this->getLocation();
    }

    public function getFilterPath()
    {
        return "/".$this->getWebPath();
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../www/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads';
    }

    public function getFileExtension()
    {
        return pathinfo($this->getLocation(), PATHINFO_EXTENSION);
    }

    abstract public function getLocation();
    abstract public function setLocation($location);
}
