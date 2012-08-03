<?php

namespace Fabfoto\GalleryBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Fabfoto\GalleryBundle\Entity\Album;
use Fabfoto\GalleryBundle\Entity\Picture;

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
        $newAlbum = new Album();
        $newAlbum->setName($albumName);
        $newAlbum->setComment($albumName);
        
        $nbImported = $this->getContainer()->get('fabfoto_gallery.picture_importer')->import($albumName);
        $output->writeLn(sprintf(' - Import finished %d elements imported',
                        $nbImported));
    }

}
