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
            new Symfony\Bundle\DoctrineMigrationsBundle\DoctrineMigrationsBundle(),
            new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),
	    new Mopa\BootstrapBundle\MopaBootstrapBundle(),
            new Mopa\BarcodeBundle\MopaBarcodeBundle(),
	    new Knp\Bundle\LastTweetsBundle\KnpLastTweetsBundle(),            
            new Knp\Bundle\ZendCacheBundle\KnpZendCacheBundle(),
            new WhiteOctober\TCPDFBundle\WhiteOctoberTCPDFBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Fabfoto\AdminBundle\FabfotoAdminBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Admingenerator\GeneratorBundle\AdmingeneratorGeneratorBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
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
            new Fabfoto\I18nBundle\FabfotoI18nBundle(),
            new Fabfoto\LastTweetBundle\FabfotoLastTweetBundle(),
	    new Liip\ImagineBundle\LiipImagineBundle(),
            new Fabfoto\TrainTimingBundle\FabfotoTrainTimingBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new CoreSphere\ConsoleBundle\CoreSphereConsoleBundle();
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
