<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Finder\Finder;
/**
 * Vcard controller.
 *
 * @Route("/vcard")
 */
class VcardController extends Controller
{
     /**
     * @Route("/about",defaults={"_format"="vcf"}, name="show_vcard")
     * 
     */
    public function showAboutAction()
    {
            $author = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Author')
                ->findOneBy(array());
            $response = new Response();
            $response->setStatusCode(200);
            $response->headers->set('Content-Type','text/x-vcard');
            $response->headers->set('Content-Disposition', 'attachment;filename="FGcard.vcf"');
            
            $vcard=$this->renderView('FabfotoGalleryBundle:Vcard:ShowAbout.vcf.twig', array(
             'author' => $author
         ));
            $response->setContent($vcard);
            return $response;
         
    }
 
}
