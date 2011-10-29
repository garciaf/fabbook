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

        if (!$file instanceof File)
        {
            throw new \InvalidArgumentException(
                    'There is no file to upload!'
            );
        }
        $fileName = $this->generateFilename($file, $randomize);


        $newFile = $file->move($this->directory, $fileName);
        $picture->setLocation($fileName);
        $this->generateMiniatureJPG($newFile);
    }

    public function upload(Picture $picture, $randomize=false)
    {
        $file = $picture->getLocation();

        if (!$file instanceof UploadedFile)
        {
            throw new \InvalidArgumentException(
                    'There is no file to upload!'
            );
        }
        $fileName = $this->generateFilename($file, $randomize);


        $newFile = $file->move($this->directory, $fileName);
        $picture->setLocation($fileName);
        $this->generateMiniatureJPG($newFile);
    }

    public function generateMiniatureJPG(File $file)
    {
        $ratio = 128;
        $source = imagecreatefromjpeg($file->getPathname());
        $size = getimagesize($file->getPathname());
        $miniature = imagecreatetruecolor($ratio, $ratio) or die("Erreur");
        if ($size[0] > $size[1])
        {
            $miniature = imagecreatetruecolor(
                    $ratio, $ratio
            );
            imagecopyresampled(
                    $miniature, $source, 0, 0, 0, 0,
                    round(($ratio / $size[1]) * $size[0]), $ratio, $size[0],
                    $size[1]);
        }
        else
        {
            $miniature = imagecreatetruecolor(
                    $ratio, $ratio
            );
            imagecopyresampled($miniature, $source, 0, 0, 0, 0, $ratio,
                    round($size[1] * ($ratio / $size[0])), $size[0], $size[1]);
        }
        $miniatureName = (string) 'mini' . $file->getFilename();

        $miniature = imagejpeg($miniature,
                $file->getPath() . '/' . $miniatureName, 100);
        return $miniature;
    }

    private function generateFilename(File $file, $randomize=false)
    {

        if ($randomize)
        {
            $filename = sprintf(
                    '%s.%s'
                    , md5(uniqid($file, true)), $file->guessExtension());
        }
        else
        {
            $filename = sprintf('%s.%s', $file->getFilename(),
                    $file->guessExtension());
        }
        if ($file instanceof UploadedFile || $randomize)
        {
            $filename=sprintf('%s.%s', $filename,$file->guessExtension());
        }
        
        return $filename;
    }

}