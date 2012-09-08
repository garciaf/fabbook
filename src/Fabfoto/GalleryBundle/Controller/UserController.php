<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Fabfoto\UserBundle\Entity\User as User;

class UserController extends BaseController
{
    /**
     * @Cache(expires="+1 week", public=true)
     * @Route("/{slug}/about", name="show_about")
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showAboutAction(User $user)
    {
        $vcard = $this->getVcardOfUser($user);

        return $this->render('FabfotoGalleryBundle:Default:ShowAbout.html.twig', array(
                    'user' => $user,
                    'vcard' => $vcard
                ));
    }

    /**
     * @Cache(expires="+1 week", public=true)
     * @Route("mobile/{slug}/about", name="show_about_mobile")
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showMobileAboutAction(User $user)
    {
        $vcard = $this->getVcardOfUser($user);

        return $this->render('FabfotoGalleryBundle:Mobile:ShowAbout.html.twig', array(
                    'user' => $user,
                    'vcard' => $vcard
                ));
    }

    /**
     * @Cache(expires="+1 week", public=true)
     * @Route("/cv/{slug}", name="show_user")
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showUserAction(User $user)
    {
        $vcard = $this->getVcardOfUser($user);

        return $this->render('FabfotoGalleryBundle:User:ShowAbout.html.twig', array(
                    'user' => $user,
                    'vcard' => $vcard
                ));
    }

}
