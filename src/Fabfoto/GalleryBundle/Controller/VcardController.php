<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
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
     * @Cache(expires="+1 week", public=true)
     * @Route("/{slug}/vcard",defaults={"_format"="vcf"}, name="show_vcard_from")
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showVcardAction(User $user)
    {
            $response = new Response();
            $response->setStatusCode(200);
            $response->headers->set('Content-Type','text/x-vcard');
            $response->headers->set('Content-Disposition', 'attachment;filename="'.$user->getSlug().'Vcard.vcf"');

            $vcard= $this->getVcardOfUser($user);

            $response->setContent($vcard);

            return $response;

    }
}
