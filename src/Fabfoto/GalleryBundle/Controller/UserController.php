<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends BaseController
{
    /**
     * @Cache(expires="tomorrow")
     * @Route("/{slug}/about", name="show_about")
     */
    public function showAboutAction($slug)
    {
        $user = $this->getUserBySlug($slug);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find user');
        }
        $vcard = $this->getVcardOfUser($user);
        
        return $this->render('FabfotoGalleryBundle:Default:ShowAbout.html.twig', array(
                    'user' => $user,
                    'vcard' => $vcard
                ));
    }

    /**
     * @Cache(expires="tomorrow")
     * @Route("/cv/{slug}", name="show_user")
     */
    public function showUserAction($slug)
    {
        $user = $this->getUserBySlug($slug);
        if (!$user) {
            throw $this->createNotFoundException('Unable to find user');
        }
        $vcard = $this->getVcardOfUser($user);
        return $this->render('FabfotoGalleryBundle:User:ShowAbout.html.twig', array(
                    'user' => $user,
                    'vcard' => $vcard
                ));
    }

}
