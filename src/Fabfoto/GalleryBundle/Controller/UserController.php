<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Fabfoto\UserBundle\Entity\User as User;

class UserController extends BaseController
{
    /**
     * @Route("/{slug}/about", name="show_about")
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showAboutAction(User $user)
    {
        $response = $this->getResponseHeader($user->getUpdatedAt());

        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;
        } else {
        $vcard = $this->getVcardOfUser($user);

        return $this->render('FabfotoGalleryBundle:Default:ShowAbout.html.twig', array(
                    'user' => $user,
                    'vcard' => $vcard
                ), $response);
        }
    }

    /**
     * @Route("mobile/{slug}/about", name="show_about_mobile")
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showMobileAboutAction(User $user)
    {
        $response = $this->getResponseHeader($user->getUpdatedAt());

        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;
        } else {
        $vcard = $this->getVcardOfUser($user);

        return $this->render('FabfotoGalleryBundle:Mobile:ShowAbout.html.twig', array(
                    'user' => $user,
                    'vcard' => $vcard
                ), $response);
        }
    }

    /**
     * @Route("/cv/{slug}", name="show_user")
     * @ParamConverter("user", class="FabfotoUserBundle:User")
     */
    public function showUserAction(User $user)
    {
        $response = $this->getResponseHeader($user->getUpdatedAt());

        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;
        } else {
        $vcard = $this->getVcardOfUser($user);

        return $this->render('FabfotoGalleryBundle:User:ShowAbout.html.twig', array(
                    'user' => $user,
                    'vcard' => $vcard
                ), $response);
        }
    }

}
