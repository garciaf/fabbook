<?php

namespace A5sys\ProjectBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListTranslationCommand extends ContainerAwareCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setName('a5sys:i18n:list')
            ->setDescription('command to get all the translation in one language')
            ->addArgument('local', InputArgument::OPTIONAL,'Who do you want to greet?')

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
        $local = $input->getArgument('local');
        $translator = $this->getContainer()->get('translator.writer');
        $catalog = $translator->getCatalog($local);
        foreach ($catalog->getDomains() as $bundleName) {
            $output->writeLn(sprintf(' Bundle <info>%s</info>', ($bundleName)));

            //$output->writeLn(sprintf(' Bundle "%s"', $bundleName));
            foreach ($catalog->all($bundleName) as $key => $value) {
                $output->writeLn(sprintf('%s:    %s', $key, $value));
            }
        }

    }

}
