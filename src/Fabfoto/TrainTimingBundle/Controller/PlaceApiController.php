<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Symfony\Component\HttpFoundation\Response as Response;

class PlaceApiController extends BaseApiController
{
    /**
     * @Route("place/{id}/json", name="place_detail", options={"expose"=true})
     *
     */
    public function getPlaceAction($id)
    {
        $place = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Place')->find($id);
        if (!$place) {
             throw $this->createNotFoundException("No place");
        }

        return $this->serializeAnswerToJSON($place);
    }
    /**
     * @Route("places/json", name="place_list", options={"expose"=true})
     *
     */
    public function getAllPlaceAction()
    {
        $category = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Category')->findOneByName('Parking Ouvrage');
        $category2 = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Category')->findOneByName('Parc en Enclos');
        $place = $this->getDoctrine()->getRepository('FabfotoTrainTimingBundle:Place')->findBy(array('category' => $category->getId()));
        if (!$place) {
             throw $this->createNotFoundException("No place");
        }

        return $this->serializeAnswerToJSON($place);

    }

}
