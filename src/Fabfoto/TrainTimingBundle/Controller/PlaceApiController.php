<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Response as Response;

class PlaceApiController extends Controller
{
    /**
     * @Route("place/{id}/json", name="place_detail", options={"expose"=true})
     * 
     */
    public function getPlaceAction($id)
    {
        $place = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Lieux')->find($id);
        if(!$place){
             throw $this->createNotFoundException("No place"); 
        }
        $serializer = $this->get('serializer');
        $objectJson = $serializer->serialize($place, 'json');
        return new Response($objectJson);        
    }
    /**
     * @Route("places/json", name="place_list", options={"expose"=true})
     * 
     */
    public function getAllPlaceAction()
    {
        $category = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Category')->findOneByName('Parking Ouvrage');
        $category2 = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Category')->findOneByName('Parc en Enclos');
        $place = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Lieux')->findBy(array('category' => $category->getId()));
        if(!$category2){
             throw $this->createNotFoundException("No place"); 
        }
        $serializer = $this->get('serializer');
        $objectJson = $serializer->serialize($place, 'json');
        return new Response($objectJson);        
        
    }
    
}
