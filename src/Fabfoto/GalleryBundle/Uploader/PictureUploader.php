<?php

namespace Fabfoto\GalleryBundle\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Fabfoto\GalleryBundle\Entity\Picture;

class PictureUploader
{

    private $directory;

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function update(Picture $picture, $randomize= false)
    {
        $file = $picture->getLocation();

        if (!$file instanceof File) {
            throw new \InvalidArgumentException(
                    'There is no file to upload!'
            );
        }
        $fileName = $this->generateFilename($file, $randomize);

        $newFile = $file->move($this->directory, $fileName);
        $picture->setLocation($fileName);
    }

    public function upload(Picture $picture, $randomize=false)
    {
        $file = $picture->getLocation();
        if (!$file instanceof UploadedFile) {
            throw new \InvalidArgumentException(
                    'There is no file to upload!'
            );
        }
        $fileName = $this->generateFilename($file, $randomize);

        $newFile = $file->move($this->directory, $fileName);
        $picture->setLocation($fileName);

    }

    private function generateFilename(File $file, $randomize=false)
    {

        if ($randomize) {
            $filename = sprintf(
                    '%s.%s'
                    , md5(uniqid($file, true)), $file->guessExtension());
        } else {
            $filename = sprintf('%s.%s', $file->getFilename(),
                    $file->guessExtension());
        }
        if ($file instanceof UploadedFile || $randomize) {
            $filename=sprintf('%s.%s', $filename,$file->guessExtension());
        }

        return $filename;
    }

}
