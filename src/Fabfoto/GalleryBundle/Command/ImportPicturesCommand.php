<?php

namespace Fabfoto\GalleryBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Fabfoto\GalleryBundle\Entity\Album;
use Fabfoto\GalleryBundle\Entity\Picture;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\File;

class ImportPicturesCommand extends ContainerAwareCommand
{

    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
                ->setName('fabfoto:picture:import')
                ->addArgument('albumName', InputArgument::OPTIONAL,
                        'The name of the album')
                ->setDescription(
                        'To import pictures in your website from the incoming directory'
                )
        ;
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return integer 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract method is not implemented
     * @see    setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $albumName = $input->getArgument('albumName');
        $nbImported = $this->getContainer()->get('fabfoto_gallery.picture_importer')->import($albumName);
//        if (!$albumName) {
//            $albumName = 'incoming';
//        }
//        $doctrine = $this->getContainer()->get('doctrine');
//        $em = $doctrine->getEntityManager();
//        $finder = new Finder();
//        $finder->files()->in($this->getContainer()->getParameter('incoming_directory'));
//        $album = new Album();
//        $album->setName($albumName);
//        $album->setComment('imported pictures');
//        $em->persist($album);
//        $index = 0;
//        foreach ($finder as $sfile) {
//
//            $picture = new Picture();
//            $picture->setName($sfile->getFilename());
//            $picture->setCreatedAt(new \DateTime());
//            $picture->setIsBackground(false);
//            $picture->setLocation(new File($sfile->getRealPath()));
//            $picture->setAlbum($album);
//            $em->persist($picture);
//
//            //Debug
//            $output->writeLn(sprintf('path of the picture%s ',
//                            $picture->getLocation()));
//
//            //
//
//            $this->getContainer()->get('fabfoto_gallery.picture_uploader')->update($picture);
//
//            $index++;
//        }
//        $em->flush();
//
        $output->writeLn(sprintf(' - Import finished %d elements imported',
                        $nbImported));
    }

}
