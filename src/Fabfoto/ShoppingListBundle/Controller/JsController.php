<?php

namespace Fabfoto\ShoppingListBundle\Controller;
use Symfony\Component\Serializer;
use Serializer\Normalizer\CustomNormalizer;
use Serializer\Encoder\XmlEncoder;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Response as Response;
class JsController extends Controller
{
    /**
     * @Route("/sync.js", name="javascript"))
     * @Template()
     */
    public function jsAction()
    {
        return $this->render("FabfotoShoppingListBundle::syncScript.js.twig");
    }
               
}
