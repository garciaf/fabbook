<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/train/when")
     */
    public function indexAction()
    {
        return $this->render('FabfotoTrainTimingBundle:Default:index.html.twig');
    }
    /**
     * @Route("/train/gare")
     */
    public function gareListAction()
    {
        return $this->render('FabfotoTrainTimingBundle:Default:listeGare.html.twig');
    }
}
