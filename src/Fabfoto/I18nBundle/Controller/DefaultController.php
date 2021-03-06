<?php

namespace Fabfoto\I18nBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
     /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $mobileDetector = $this->get('mobile_detector');
        if ($mobileDetector->isMobile()) {
            return $this->redirect($this->generateUrl('index_mobile'));
        } else {
            return $this->redirect($this->generateUrl('show_articles'));
        }

    }
}
