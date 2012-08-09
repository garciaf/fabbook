<?php

namespace Fabfoto\GalleryBundle\Import;

use Doctrine\ORM\EntityManager as EntityManager;
use Fabfoto\GalleryBundle\Uploader\PictureUploader;
use Fabfoto\GalleryBundle\Entity\Album;
use Fabfoto\GalleryBundle\Entity\Picture;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;

class PictureImporter
{
    protected $em;
    protected $incomingFolder;
    protected $uploader;
    protected $incomingFolderName;

    /**
     *
     * @param EntityManager   $entityManager
     * @param PictureUploader $uploader
     * @param type            $incoming_directory
     */
    public function __construct(EntityManager $entityManager, PictureUploader $uploader, $import_directory)
    {
        $this->em = $entityManager;
        $this->uploader = $uploader;
        $this->incomingFolder = $import_directory;
        $this->incomingFolderName = basename($this->incomingFolder);
    }

    /**
     *
     * @param type $albumName
     */
    public function import(Album $newAlbum)
    {
        $albumName = $newAlbum->getName();
        if ($albumName) {
            $album = $this->em
                    ->getRepository('FabfotoGalleryBundle:Album')
                    ->findOneByName($albumName);
        }

        if (!$album) {
            $album = $newAlbum;
        } else {
            $album->setComment($newAlbum->getComment());
            $album->setCategory($newAlbum->getCategory());
        }
        $this->em->persist($album);

        $index = 0;
        $finder = new Finder();
        $finder->files()->in($this->incomingFolder);
        foreach ($finder as $sfile) {

            $picture = new Picture();
            $picture->setName($sfile->getFilename());
            $picture->setCreatedAt(new \DateTime());
            $picture->setIsBackground(false);
            $picture->setLocation(new File($sfile->getRealPath()));
            $picture->setAlbum($album);
            $this->em->persist($picture);
            //

            $this->uploader->update($picture);

            $index++;
        }
        $this->em->flush();

        return $index;
    }

    public function getFileToImport()
    {
        $files = array();
        $finder = new Finder();
        $finder->files()->in($this->incomingFolder);
        foreach ($finder as $index => $sfile) {
            $files[$index]["fileName"] = $sfile->getFilename();
            $files[$index]["aTime"] = $sfile->getATime();
            $url = parse_url($sfile->getRealPath());
            $files[$index]["webPath"] = '/'.$this->incomingFolderName.'/'.$sfile->getFilename();
        }

        return $files;
    }

}
