<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Fabfoto\GalleryBundle\FabfotoGalleryBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),		
            new Mopa\Bundle\BarcodeBundle\MopaBarcodeBundle(),
            //new WhiteOctober\TCPDFBundle\WhiteOctoberTCPDFBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Fabfoto\AdminBundle\FabfotoAdminBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Admingenerator\GeneratorBundle\AdmingeneratorGeneratorBundle(),
            new Admingenerator\OldThemeBundle\AdmingeneratorOldThemeBundle(),
            new Admingenerator\ActiveAdminThemeBundle\AdmingeneratorActiveAdminThemeBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Fabfoto\UserBundle\FabfotoUserBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new FOS\CommentBundle\FOSCommentBundle(),
            new Fabfoto\I18nBundle\FabfotoI18nBundle(),
            new Fabfoto\TrainTimingBundle\FabfotoTrainTimingBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new FBK\MobileDetectorBundle\FBKMobileDetectorBundle(),
            new Fabfoto\OverrideUserBundle\FabfotoOverrideUserBundle(),
            new Knp\Bundle\LastTweetsBundle\KnpLastTweetsBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }
        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
