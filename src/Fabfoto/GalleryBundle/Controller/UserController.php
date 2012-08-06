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
     * @Cache(expires="tomorrow")
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
     * @Cache(expires="tomorrow")
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
