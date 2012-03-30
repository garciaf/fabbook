<?php

namespace Fabfoto\ShoppingListBundle\Controller;
use Symfony\Component\Serializer;
use Serializer\Normalizer\CustomNormalizer;
use Serializer\Encoder\XmlEncoder;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Response as Response;
class ManifestController extends Controller
{
    /**
     * @Route("manifest", name="manifest"))
     * @Template()
     */
    public function manifestAction()
    {
        // Recuperation du dernier element pour avoir la date de dernière mise à jour et changer la cache en fonction
                $items = $this
                ->getDoctrine()
                ->getRepository('FabfotoShoppingListBundle:Item')
                ->findBy(array(), array('updatedAt' => 'DESC'));
               $item = $items[0];
        return $this->render("FabfotoShoppingListBundle:Manifest:manifest.html.twig", array(
            'item' => $item
        ));
    }
               
}
