<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class DefaultController extends Controller
{
    /**
     * @Cache(expires="tomorrow")
     * @Route("/train/when", name="when_train_app")
     */
    public function indexAction()
    {
        return $this->render('FabfotoTrainTimingBundle:Default:index.html.twig');
    }

    /**
     * @Route("/parking/available", name="where_park_app")
     */
    public function parkingListAction()
    {
        return $this->render('FabfotoTrainTimingBundle:Default:listeParking.html.twig');
    }
}
