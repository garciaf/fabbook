<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MobileController extends Controller
{
    /**
     * @Route("mobile/train/when", name="mobile_when_train_app")
     */
    public function indexAction()
    {
        return $this->render('FabfotoTrainTimingBundle:Mobile:index.html.twig');
    }
}
