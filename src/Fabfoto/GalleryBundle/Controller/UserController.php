<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

        /**
     * @Route("/{slug}/about", name="show_about")
     */
    public function showAboutAction($slug) {

        $author = $this->getUserBySlug($slug);
        if (!$author) {
            throw $this->createNotFoundException('Unable to find user');
        }
        return $this->render('FabfotoGalleryBundle:Default:ShowAbout.html.twig', array(
                    'author' => $author
                ));
    }

    /**
     * @Route("/{slug}", name="show_user")
     */
    public function showUserAction($slug) {

        $author = $this->getUserBySlug($slug);
        if (!$author) {
            throw $this->createNotFoundException('Unable to find user');
        }
        return $this->render('FabfotoGalleryBundle:User:ShowAbout.html.twig', array(
                    'author' => $author
                ));
    }
    /**
     * Function to retrieve user by slug name
     */
    protected function getUserBySlug($slug){
        return $this
                ->getDoctrine()
                ->getRepository('FabfotoUserBundle:User')
                ->findOneBySlug($slug);
    }
}

?>
