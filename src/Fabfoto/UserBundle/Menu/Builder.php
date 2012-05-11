<?php

namespace Fabfoto\UserBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());
        
        $menu->setchildrenAttributes(array('id' => 'main_navigation', 'class'=>'menu'));
        $menu->addChild('About Me', array(
            'route' => 'user_show',
        ));
        $menu->addChild('Portrait', array('route' => 'user_portrait'));

        $menu->addChild('Logout', array(
            'route' => 'fabfoto_logout',
        ));
        // ... add more children

        return $menu;
    }
}