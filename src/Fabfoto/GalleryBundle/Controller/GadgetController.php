<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GadgetController extends Controller
{
    /**
     * @Cache(expires="+1 week", public=true)
     * @Route("/gadget/list", name="gadget_index")
     */
    public function gadgetListAction()
    {
        return $this->render('FabfotoGalleryBundle:Gadget:IndexGadget.html.twig');
    }
 }
