<?php

namespace A5sys\ProjectBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Config\Resource\FileResource as FileResource;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Filesystem\Filesystem;

class DumpTranslationCommand extends ContainerAwareCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setName('a5sys:i18n:dump')
            ->setDescription('command to dump in YML')
            ->addArgument('local', InputArgument::OPTIONAL,'choose the language of generation')
            ->addOption('override', null, InputOption::VALUE_NONE, 'If set, the ressources will be overwritten')
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
        $path='';
        if ($input->getOption('override')) {
            $path = 'app/Resources/translations/';
        }
        $translator = $this->getContainer()->get('translator.writer');
        $catalog = $translator->getCatalog($local);
        foreach ($catalog->getDomains() as $bundleName) {
            $output->writeLn(sprintf(' Bundle <info>%s</info>', ($bundleName)));
            $fileName= $path.$bundleName.'.'.$local.'.yml';
            $yaml = Yaml::dump($catalog->all($bundleName));
            $fileSystem = new Filesystem();
            $fileSystem->touch($fileName);
            file_put_contents($fileName, $yaml);
            $output->writeLn($yaml, OutputInterface::OUTPUT_RAW);
            
        }

    }

}
