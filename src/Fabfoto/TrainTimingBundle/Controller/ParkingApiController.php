<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Response as Response;

class ParkingApiController extends Controller
{
    /**
     * @Route("ajax/parking/free", name="list_parking_free", options={"expose"=true})
     * 
     */
    public function listeParkingAction()
    {
        $url = "http://data.nantes.fr/api/getDisponibiliteParkingsPublics/1.0/39W9VSNCSASEOGV/?output=json";
        
        return new Response(@file_get_contents($url));
        
    }
    
    
}
