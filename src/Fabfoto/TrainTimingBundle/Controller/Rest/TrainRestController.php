<?php

namespace Fabfoto\TrainTimingBundle\Controller\Rest;

use \Symfony\Component\HttpFoundation\Response as Response;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations\Prefix,
    FOS\RestBundle\Controller\Annotations\NamePrefix,
    FOS\RestBundle\Controller\Annotations\View,
    FOS\RestBundle\View\RouteRedirectView,
    FOS\RestBundle\View\View AS FOSView,
    FOS\RestBundle\Controller\Annotations\QueryParam,
    FOS\RestBundle\Request\QueryFetcher;

class TrainRestController extends Controller
{

    public function getGaresAction()
    {
        $station = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Station')->findBy(array('stationType' => 0));

        $serializer = $this->get('serializer');
        $objectJson = $serializer->serialize($station, 'json');

        return new Response($objectJson);
    }
// "get_contacts"    
//[GET] /contacts
    public function getlisteStationTimingAction($codeGare)
    {
        $url = sprintf("http://sncf.mobi/infotrafic/iphoneapp/ddge/?gare=%s",$codeGare);

        return new Response(@file_get_contents($url));

    }

}
