<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Response as Response;

class TrainApiController extends Controller
{
    /**
     * @Route("ajax/gares/liste", name="liste_gare", options={"expose"=true})
     * 
     */
    public function listeGareAction()
    {
        $url = "http://sncf.mobi/infotrafic/iphoneapp/gares/index/lastUpdate/20090116182247";
        $fetcher = $this->get('train_timing.gare_fetcher');
        $gares = $fetcher->fetch();
        
        $serializer = $this->get('serializer');
        $objectJson = $serializer->serialize($gares, 'json');
        return new Response($objectJson);        
        //return new Response(@file_get_contents($url));
        
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
