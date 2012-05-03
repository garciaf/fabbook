<?php
namespace Fabfoto\GalleryBundle\Entity;

abstract class AbstractImage {


    public function getAbsolutePath() {
        return null === $this->getLocation() ? null : $this->getUploadRootDir() . '/' . $this->getLocation();
    }

    public function getWebPath() {
        return null === $this->getLocation() ? null : $this->getUploadDir() . '/' . $this->getLocation();
    }

    public function getThumbPath() {
        return null === $this->getLocation() ? null : $this->getUploadDir() . '/mini' . $this->getLocation();
    }

    public function getAbsoluteThumbPath() {
        return null === $this->getLocation() ? null : $this->getUploadRootDir() . '/mini' . $this->getLocation();
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../www/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads';
    }
    abstract function getLocation(); 
    abstract function setLocation($location); 
}

