<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Symfony\Component\HttpFoundation\Response as Response;

class TrainApiController extends BaseApiController
{
    /**
     * @Route("ajax/gares/liste", name="liste_gare", options={"expose"=true})
     *
     */
    public function listeGareAction()
    {
        $stations = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Station')->findBy(array('stationType' => 0));

        return serializeAnswerToJSON($stations);

    }

    /**
     * @Route("ajax/station/timing/{codeGare}", name="liste_timing_station", options={"expose"=true})
     *
     */
    public function listeStationTimingAction($codeGare)
    {
        $url = sprintf("http://sncf.mobi/infotrafic/iphoneapp/ddge/?gare=%s",$codeGare);

        return new Response($this->file_get_contents_curl($url));

    }

}
