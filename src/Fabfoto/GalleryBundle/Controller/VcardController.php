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
class VcardController extends BaseController
{

    /**
     * @Route("/{slug}/vcard",defaults={"_format"="vcf"}, name="show_vcard_from")
     *
     */
    public function showVcardAction($slug)
    {
            $user = $this->getUserBySlug($slug);
            if (!$user) {
                throw $this->createNotFoundException("No user") ;
            }
            $response = new Response();
            $response->setStatusCode(200);
            $response->headers->set('Content-Type','text/x-vcard');
            $response->headers->set('Content-Disposition', 'attachment;filename="'.$user->getSlug().'Vcard.vcf"');

            $vcard= $this->getVcardOfUser($user);
            
            $response->setContent($vcard);

            return $response;

    }
}
