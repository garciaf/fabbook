<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Symfony\Component\HttpFoundation\Response as Response;

class TrainApiController extends Controller
{
    /**
     * @Route("ajax/gares/liste", name="liste_gare", options={"expose"=true})
     *
     */
    public function listeGareAction()
    {
        $station = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Station')->findBy(array('stationType' => 0));

        $serializer = $this->get('serializer');
        $objectJson = $serializer->serialize($station, 'json');

        return new Response($objectJson);

    }

    /**
     * @Route("ajax/station/timing/{codeGare}", name="liste_timing_station", options={"expose"=true})
     *
     */
    public function listeStationTimingAction($codeGare)
    {
        $url = sprintf("http://sncf.mobi/infotrafic/iphoneapp/ddge/?gare=%s",$codeGare);

        return new Response(@file_get_contents($url));

    }

}
