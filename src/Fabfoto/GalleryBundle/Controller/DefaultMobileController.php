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
class DefaultMobileController extends BaseController
{
    /**
     * @Route("/", name="index_mobile")
     * @Template()
     */
    public function showArticlesAction()
    {
        $articles = $this->getNews();

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
        $albums = $this->getAlbums();
        
        return $this->render('FabfotoGalleryBundle:Mobile:indexAlbum.html.twig',
                        array('albums' => $albums));
    }

    /**
     * @Route("/{id}/album", name="show_album_mobile")
     * @Template()
     */
    public function showAlbumAction($id)
    {
        
        $album = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->find($id);
        if (!$album) {
            throw $this->createNotFoundException("No article");
        }
        $pictures = $this->getAlbumPicture($album);
        
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
        $album = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->find($id);
        if (!$album) {
            throw $this->createNotFoundException("No article");
        }
        $pictures = $this->getAlbumPicture($album);
        
        return $this->render('FabfotoGalleryBundle:Mobile:ShowAlbumAjax.html.twig',
                        array(
                    'pictures' => $pictures,
                    'album' => $album,
                ));
    }
     /**
     * @Route("/blog", name="index_blog_mobile")
     */
    public function indexBlogsAction()
    {
        $articlesBlogs = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findBy(array('isPublished' => true), array('createdAt'=> 'DESC'));

        return $this->render('FabfotoGalleryBundle:Mobile:IndexArticleBlog.html.twig',
                        array(
                    'articlesBlogs' => $articlesBlogs,
                ));
    }
     /**
     * @Route("/{slugblog}/blogarticle", name="show_article_blog_mobile")
     */
    public function showBlogArticleAction($slugblog)
    {
        $article = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findOneBy(array('slugblog' => $slugblog, 'isPublished' => true ));

        return $this->render('FabfotoGalleryBundle:Mobile:ShowArticleBlog.html.twig',
                        array(
                    'article' => $article
                ));
    }

}
