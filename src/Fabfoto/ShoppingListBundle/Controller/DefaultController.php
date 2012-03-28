<?php

namespace Fabfoto\ShoppingListBundle\Controller;
use Symfony\Component\Serializer;
use Serializer\Normalizer\CustomNormalizer;
use Serializer\Encoder\XmlEncoder;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Response as Response;
class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    
    /**
     * @Route("itemChangesince", name="last_update_item")
     * @Template()
     * 
     */
    public function updatedObjectSinceAction(){
        $sinceRequest = $this->getRequest()->get('since');
        $now = time();
        $since =New \DateTime();
        $since->setTimestamp($sinceRequest);
        
        $items = $this
                    ->getDoctrine()
                    ->getRepository('FabfotoShoppingListBundle:Item')
                    ->searchAfterDate($since);
        
        $results = array("now" => $now, "updates" => $this->turnObjectInArray($items));

        return new Response(json_encode($results));
    }
    
    private function turnObjectInArray($items){
        $result=array();
        foreach ($items as $item){
            $result[] = $this->serializeItem($item);
        }
        return $result;
    }
    private function serializeItem(\Fabfoto\ShoppingListBundle\Entity\Item $item) {
        return array(
            "id" => $item->getRemoteId(),
            "name" => $item->getName(),
            "checked" => $item->getChecked(),
            "favorite" => $item->getFavorite(),
            "onlist" => $item->getOnlist(),
            "quantity" => $item->getQuantity(),
        );
    } 
           
}
