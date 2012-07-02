<?php

namespace Fabfoto\TrainTimingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Response as Response;

class BaseApiController extends Controller
{
    /**
     * Function to serialize in json any object
     */
    protected function serializeAnswerToJSON($object)
    {
        $serializer = $this->get('serializer');
        $objectJson = $serializer->serialize($object, 'json');

        return new Response($objectJson);
    }

    /**
     * Function to replace get content with curl
     */
    protected function file_get_contents_curl($url)
    {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

}
