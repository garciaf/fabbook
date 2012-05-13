<?php

namespace Fabfoto\UserBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function userMenu(FactoryInterface $factory, array $options)
    {
        $currentUser = $this->container->get('security.context')->getToken()->getUser();

        $menu = $factory->createItem('root');
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());
        
        $menu->setchildrenAttributes(array('id' => 'main_navigation', 'class'=>'menu'));
        $menu->addChild('About Me', array(
            'route' => 'user_show',
        ));
        $menu->addChild('Portrait', array('route' => 'user_portrait'));
	
	if($currentUser->hasRole('ROLE_SUPER_ADMIN')){
	    $menu->addChild('Admin', array('route' => 'Fabfoto_AdminBundle_Blog_list'));
	    $menu->addChild('Blog', array('route' => 'writter_blog'));
	}
	if($currentUser->hasRole('ROLE_SUPER_ADMIN') or $currentUser->hasRole('ROLE_WRITER')){
	    $menu->addChild('Blog', array('route' => 'writter_blog'));
	}        
	$menu->addChild('Logout', array(
            'route' => 'fabfoto_logout',
        ));

        // ... add more children

        return $menu;
    }
}
