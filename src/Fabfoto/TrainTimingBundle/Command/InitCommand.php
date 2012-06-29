<?php
namespace Fabfoto\TrainTimingBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('train:init')
            ->setDescription('Command to save the station in database')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fetcher = $this->getContainer()->get('train_timing.gare_fetcher');
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getEntityManager();

        $stationsOld  = $doctrine->getRepository('FabfotoTrainTimingBundle:Station')->findAll();
        foreach ($stationsOld as $stationOld) {
            $em->remove($stationOld);
        }

        $stations = $fetcher->fetch();
        $nbStation = 0;

        foreach ($stations as $station) {
            $em->persist($station);
            $nbStation++;
        }

        $em->flush();
        $output->writeln(sprintf('imported %d stations in the app', $nbStation));
    }
}
