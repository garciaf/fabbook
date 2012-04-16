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
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Fabfoto\GalleryBundle\FabfotoGalleryBundle(),
            new Gregwar\CaptchaBundle\GregwarCaptchaBundle(),
	    new Io\FormBundle\IoFormBundle(),
            new Symfony\Bundle\DoctrineMigrationsBundle\DoctrineMigrationsBundle(),
            new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),
	    new Mopa\BootstrapBundle\MopaBootstrapBundle(),
            new Mopa\BarcodeBundle\MopaBarcodeBundle(),
	    new Knp\Bundle\LastTweetsBundle\KnpLastTweetsBundle(),            
            new Knp\Bundle\ZendCacheBundle\KnpZendCacheBundle(),
            new Fabfoto\ZendTweetBundle\FabfotoZendTweetBundle(),
            new WhiteOctober\TCPDFBundle\WhiteOctoberTCPDFBundle(),
            new Zenstruck\Bundle\MobileBundle\ZenstruckMobileBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Admingenerator\GeneratorBundle\AdmingeneratorGeneratorBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new Fabfoto\AdminBundle\FabfotoAdminBundle(),
            new Symfony\Bundle\DoctrineFixturesBundle\DoctrineFixturesBundle(),
            new Admingenerator\ActiveAdminThemeBundle\AdmingeneratorActiveAdminThemeBundle(),
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Fabfoto\UserBundle\FabfotoUserBundle(),
            new Admingenerator\UserBundle\AdmingeneratorUserBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new FOS\CommentBundle\FOSCommentBundle(),
            new Exercise\HTMLPurifierBundle\ExerciseHTMLPurifierBundle(),


        );

        if (in_array($this->getEnvironment(), array('dev', 'test','prod'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new CoreSphere\ConsoleBundle\CoreSphereConsoleBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
