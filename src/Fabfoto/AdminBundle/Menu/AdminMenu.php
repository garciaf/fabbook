<?php
namespace Fabfoto\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Symfony\Component\DependencyInjection\ContainerAware;

class AdminMenu extends ContainerAware
{
    protected $factory;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param Request $request
     * @param Router  $router
     */
    public function createAdminMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        //$menu->setCurrentUri($request->getRequestUri());

        $menu->setchildrenAttributes(array('id' => 'main_navigation', 'class'=>'menu'));

        //Media part
        $media = $menu->addChild('Media', array('uri' => '#'));
        $media->setLinkAttributes(array('class'=>'sub main'));
        $media->addChild('Album', array('route' => 'Fabfoto_AdminBundle_Album_list'));
        $media->addChild('Picture', array('route' => 'Fabfoto_AdminBundle_Picture_list'));
        $media->addChild('Category', array('route' => 'Fabfoto_AdminBundle_CategoryBlog_list'));

        //Blog Part
        $blog = $menu->addChild('Blog', array('uri' => '#'));
        $blog->setLinkAttributes(array('class'=>'sub main'));
        $blog->addChild('News', array('route' => 'Fabfoto_AdminBundle_News_list'));
        $blog->addChild('Blog', array('route' => 'Fabfoto_AdminBundle_Blog_list'));
        $blog->addChild('Cover', array('route' => 'Fabfoto_AdminBundle_Cover_list'));
        $blog->addChild('Tag', array('route' => 'Fabfoto_AdminBundle_Tag_list'));
        $blog->addChild('Comment', array('route' => 'Fabfoto_AdminBundle_Comment_list'));
        $blog->addChild('Messages', array('route' => 'Fabfoto_AdminBundle_Message_list'));

        //Me
        $me = $menu->addChild('You', array('route' => 'user_show'));
        //User Part
        $user = $menu->addChild('User', array('route' => 'Fabfoto_AdminBundle_User_list'));
        $user->addChild('Portrait', array('route' => 'Fabfoto_AdminBundle_Portrait_list'));

        $gadget = $menu->addChild('Experiment', array('uri' => '#'));
        $gadget->setLinkAttributes(array('class'=>'sub main'));
        $gadget->addChild('Station', array('route' => 'Fabfoto_AdminBundle_Station_list'));
        $gadget->addChild('Place', array('route' => 'Fabfoto_AdminBundle_Place_list'));

        return $menu;
    }
}
