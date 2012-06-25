<?php

namespace Fabfoto\GalleryBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FabfotoGalleryExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('fabfoto_gallery.picture_directory', $config['picture_directory']);
        $container->setParameter('fabfoto_gallery.mailsender', $config['mailsender']);
        $container->setParameter('fabfoto_gallery.nbArticle', $config['nbArticle']);
        $container->setParameter('fabfoto_gallery.nbAlbum', $config['nbAlbum']);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
