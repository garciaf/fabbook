<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/train/when", name="when_train_app")
     */
    public function indexAction()
    {
        return $this->render('FabfotoTrainTimingBundle:Default:index.html.twig');
    }
    /**
     * @Route("/train/where")
     */
    public function gareListAction()
    {
        return $this->render('FabfotoTrainTimingBundle:Default:listeGare.html.twig');
    }
    /**
     * @Route("/parking/available", name="where_park_app")
     */
    public function parkingListAction()
    {
        return $this->render('FabfotoTrainTimingBundle:Default:listeParking.html.twig');
    }
}
