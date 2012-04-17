<?php
namespace Fabfoto\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminMenu
{
    private $factory;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }
    
    /**
     * @param Request $request
     * @param Router $router
     */
    public function createAdminMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->setCurrentUri($request->getRequestUri());
        
        $menu->setchildrenAttributes(array('id' => 'main_navigation', 'class'=>'menu'));

        //Media part
        $media = $menu->addChild('Media', array('uri' => '#'));
        $media->setLinkAttributes(array('class'=>'sub main'));
        $media->addChild('Album', array('route' => 'Fabfoto_AdminBundle_Album_list'));
        $media->addChild('Picture', array('route' => 'Fabfoto_AdminBundle_Picture_list'));
        
        //Blog Part
        $blog = $menu->addChild('Blog', array('uri' => '#'));
        $blog->setLinkAttributes(array('class'=>'sub main'));
        $blog->addChild('News', array('route' => 'Fabfoto_AdminBundle_News_list'));
        $blog->addChild('Blog', array('route' => 'Fabfoto_AdminBundle_Blog_list'));
        $blog->addChild('Tag', array('route' => 'Fabfoto_AdminBundle_Tag_list'));
        $blog->addChild('Comment', array('route' => 'Fabfoto_AdminBundle_Comment_list'));
        $blog->addChild('Messages', array('route' => 'Fabfoto_AdminBundle_Message_list'));
        
        //Author Part
        $author = $menu->addChild('About', array('route' => 'Fabfoto_AdminBundle_Author_list'));
        
        //User Part
        $user = $menu->addChild('User', array('route' => 'Fabfoto_AdminBundle_User_list'));
        $user->addChild('Portrait', array('route' => 'Fabfoto_AdminBundle_Portrait_list'));
        return $menu;
    }
}

