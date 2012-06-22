<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class GadgetController extends Controller {
    /**
     * @Route("/gadget/list", name="gadget_index")
     */
    public function gadgetListAction() {
        return $this->render('FabfotoGalleryBundle:Gadget:IndexGadget.html.twig');
    }
 }
