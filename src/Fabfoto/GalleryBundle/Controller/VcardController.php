<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Fabfoto\UserBundle\Entity\User as User;

/**
 * Vcard controller.
 *
 * @Route("/vcard")
 */
class VcardController extends BaseController
{
    /**
     * @Route("/{slug}/vcard",defaults={"_format"="vcf"}, name="show_vcard_from")
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showVcardAction(User $user)
    {
        $response = $this->getResponseHeader($user->getUpdatedAt());

        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;
        } else {
            $response = new Response();
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/x-vcard');
            $response->headers->set('Content-Disposition', 'attachment;filename="' . $user->getSlug() . 'Vcard.vcf"');

            $vcard = $this->getVcardOfUser($user);

            $response->setContent($vcard);

            return $response;
        }
    }

}
