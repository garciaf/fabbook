<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Article controller.
 *
 * @Route("/mobile")
 */
class DefaultMobileController extends Controller
{
    /**
     * @Route("/", name="index_mobile")
     * @Template()
     */
    public function showArticlesAction()
    {
        $articles = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->findBy(array(), array('createdAt'=> 'DESC'));
        return $this->render('FabfotoGalleryBundle:Mobile:IndexArticle.html.twig',
                        array(
                    'articles' => $articles
                ));
    }
    /**
     * @Route("/{id}/article", name="show_article_mobile")
     */
    public function showArticleAction($id)
    {
        $article = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->find($id);
        return $this->render('FabfotoGalleryBundle:Mobile:showArticle.html.twig',
                        array(
                    'article' => $article
                ));
    }
    /**
     * @Route("/albums", name="albums_mobile")
     * @Template()
     */
    public function indexAlbumsAction()
    {
        $albums = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->findBy(array(), array('createdAt'=> 'DESC'));
        return $this->render('FabfotoGalleryBundle:Mobile:indexAlbum.html.twig',
                        array('albums' => $albums));
    }

    /**
     * @Route("/{id}/album", name="show_album_mobile")
     * @Template()
     */
    public function showAlbumAction($id)
    {
        $pictures = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Picture')
                ->findBy(array(
            'album' => $id,
            'isBackground' => false
                ));
        $album = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->find($id);
        return $this->render('FabfotoGalleryBundle:Mobile:ShowAlbum.html.twig',
                        array(
                    'pictures' => $pictures,
                    'album' => $album,
                ));
    }
    /**
     * @Route("/{id}/ajaxalbum", name="show_album_mobile_ajax")
     * @Template()
     */
    public function showAlbumAjaxAction($id)
    {
        $pictures = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Picture')
                ->findBy(array(
            'album' => $id,
            'isBackground' => false
                ));
        $album = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->find($id);
        return $this->render('FabfotoGalleryBundle:Mobile:ShowAlbumAjax.html.twig',
                        array(
                    'pictures' => $pictures,
                    'album' => $album,
                ));
    }


}
