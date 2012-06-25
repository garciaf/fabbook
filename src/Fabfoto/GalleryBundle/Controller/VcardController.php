<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
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

            $vcard=$author->getVcard();
            $response->setContent($vcard);

            return $response;

    }
    /**
     * @Route("/{slug}/vcard",defaults={"_format"="vcf"}, name="show_vcard_from")
     *
     */
    public function showVcardAction($slug)
    {
            $author = $this
                ->getDoctrine()
                ->getRepository('FabfotoUserBundle:User')
                ->findOneBy(array(
                    'slug' => $slug
                ));
            $response = new Response();
            $response->setStatusCode(200);
            $response->headers->set('Content-Type','text/x-vcard');
            $response->headers->set('Content-Disposition', 'attachment;filename="'.$author->getSlug().'Vcard.vcf"');

            $vcard=$author->getVcard();
            $response->setContent($vcard);

            return $response;

    }
}
