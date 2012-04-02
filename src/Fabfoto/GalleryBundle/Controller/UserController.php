<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {
    /**
     * @Route("/{slug}/about", name="show_user")
     */
    public function showAboutAction($slug) {

        $author = $this
                ->getDoctrine()
                ->getRepository('FabfotoUserBundle:User')
                ->findOneBySlug($slug);
        return $this->render('FabfotoGalleryBundle:Default:ShowAbout.html.twig', array(
                    'author' => $author
                ));
    }
}
?>
