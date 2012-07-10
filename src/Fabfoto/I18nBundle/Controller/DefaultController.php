<?php

namespace Fabfoto\I18nBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
     /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $mobileDetector = $this->get('app.mobiledetectorbundle.mobile_detector');
        if($mobileDetector->isMobile()){
            return $this->redirect($this->generateUrl('index_mobile'));
        }else{
            return $this->redirect($this->generateUrl('show_articles'));
        }
        
    }
}
