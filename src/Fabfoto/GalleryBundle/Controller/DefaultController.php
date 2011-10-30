<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="show_articles")
     * @Template()
     */
    public function showArticlesAction()
    {
        $articles = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->findAll();
        return $this->render('FabfotoGalleryBundle:Default:IndexArticle.html.twig',
                        array(
                    'articles' => $articles
                ));
    }
     /**
     * @Route("albums", name="index_album")
     * @Template()
     */
    public function indexAlbumsAction()
    {
        $albums = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->findAll();
        return $this->render('FabfotoGalleryBundle:Default:indexAlbum.html.twig',
                        array('albums' => $albums));
    }
    /**
     * @Route("rss", name="rss_news")
     * @Template()
     */
    public function rssNewsAction()
    {
        $articles = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->findAll();
        return $this->render('FabfotoGalleryBundle:Default:RSSNews.xml.twig',
                        array('articles' => $articles));
    }

    /**
     * @Route("{id}/album", name="show_album")
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
        $backgrounds = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Picture')
                ->findBy(array(
            'album' => $id,
            'isBackground' => true
                ));
        $album = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->find($id);
        return $this->render('FabfotoGalleryBundle:Default:ShowAlbum.html.twig',
                        array(
                    'pictures' => $pictures,
                    'album' => $album,
                    'backgrounds' => $backgrounds
                ));
    }

    public function allBackgroundAction($max)
    {
        $backgrounds = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Picture')
                ->findByisBackground(true);
        return $this->render('FabfotoGalleryBundle:Default:Background.html.twig',
                        array(
                    'backgrounds' => $backgrounds
                ));
    }

    /**
     * @Route("search", name="fabfoto_search")
     * @Template()
     */
    public function searchPictureAction(Request $request)
    {   
        $pictures = array();
        $albums = array();
        if ($request->query->get('q'))
        {
            $pictures = $this
                    ->getDoctrine()
                    ->getRepository('FabfotoGalleryBundle:Picture')
                    ->search($request->query->get('q'));
            $albums = $this
                    ->getDoctrine()
                    ->getRepository('FabfotoGalleryBundle:Album')
                    ->search($request->query->get('q'));
        }
        return $this->render('FabfotoGalleryBundle:Default:SearchResult.html.twig',
                        array(
                    'albums' => $albums,
                    'pictures' => $pictures,
                    'keywords' => $request->query->get('q'),
                        )
        );
    }

}
