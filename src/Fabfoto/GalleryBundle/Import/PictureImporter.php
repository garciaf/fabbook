<?php

namespace Fabfoto\GalleryBundle\Import;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Doctrine\ORM\EntityManager as EntityManager;
use Fabfoto\GalleryBundle\Uploader\PictureUploader;
use Fabfoto\GalleryBundle\Entity\Album;
use Fabfoto\GalleryBundle\Entity\Picture;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;

class PictureImporter {

    protected $em;
    protected $incomingFolder;
    protected $uploader;

    /**
     *
     * @param EntityManager $entityManager
     * @param PictureUploader $uploader
     * @param type $incoming_directory 
     */
    public function __construct(EntityManager $entityManager, PictureUploader $uploader, $import_directory) {
        $this->em = $entityManager;
        $this->uploader = $uploader;
        $this->incomingFolder = $import_directory;
    }

    /**
     *
     * @param type $albumName 
     */
    public function import($albumName) {
        if ($albumName) {
            $album = $this->em
                    ->getRepository('FabfotoGalleryBundle:Album')
                    ->findOneByName($albumName);
        }

        if (!$album) {
            $album = new Album();
            $album->setName($albumName);
            $album->setComment($albumName);
            $this->em->persist($album);
        }
        $finder = new Finder();
        $finder->files()->in($this->incomingFolder);
        $index = 0;
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

}