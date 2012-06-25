<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\Response as Response;
/**
 * Article controller.
 *
 */
class ManifestController extends Controller
{
    /**
     * @Route("manifest/", name="manifest_mobile")
     * @Template()
     */
    public function buildManifestAction()
    {
       $response = new Response();
       $response->headers->set('Content-Type', 'text/cache-manifest');
       $response->sendHeaders();

        $news = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->findBy(array(), array('createdAt'=> 'DESC'));
        $articles = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findBy(array('isPublished' => true), array('createdAt'=> 'DESC'));

        return $this->render('FabfotoGalleryBundle:Manifest:manifest.txt.twig',
                        array(
                    'articles' => $articles,
                    'news' => $news
                ), $response);
    }
    /**
     * @Route("offlinepage/", name="manifest_offline")
     * @Template()
     */
    public function buikdOffLinePageAction()
    {
        return $this->render('FabfotoGalleryBundle:Manifest:offline.html.twig');
    }
}
