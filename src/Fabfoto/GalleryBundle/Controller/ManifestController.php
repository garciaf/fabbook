<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Article controller.
 *
 */
class ManifestController extends Controller
{
    /**
     * @Route("manifest", name="manifest_mobile")
     * @Template()
     */
    public function buildManifestAction()
    {
        $news = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->findBy(array(), array('createdAt'=> 'DESC'));
        $articles = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findBy(array(), array('createdAt'=> 'DESC'));
        return $this->render('FabfotoGalleryBundle:Manifest:manifest.html.twig',
                        array(
                    'articles' => $articles,
                    'news' => $news
                ));
    }
    /**
     * @Route("offlinepage", name="manifest_offline")
     * @Template()
     */
    public function buikdOffLinePageAction(){
        return $this->render('FabfotoGalleryBundle:Manifest:offline.html.twig');
    }
}
