<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Fabfoto\GalleryBundle\Entity\Album as Album;
use Fabfoto\GalleryBundle\Entity\ArticleBlog as ArticleBlog;
use Fabfoto\GalleryBundle\Entity\Article as Article;

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
        $lastNews  = $this->getLastNews();
        $response = $this->getResponseHeader($lastNews->getUpdatedAt());

        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;
        } else {
        $articles = $this->getNews();

        return $this->render('FabfotoGalleryBundle:Mobile:IndexArticle.html.twig',
                        array(
                    'articles' => $articles
                ));
        }
    }
    /**
     * @Cache(expires="+1 week")
     * @Route("/{id}/article", name="show_article_mobile")
     * @ParamConverter("article", class="FabfotoGalleryBundle:Article")
     */
    public function showArticleAction(Article $article)
    {
        return $this->render('FabfotoGalleryBundle:Mobile:showArticle.html.twig',
                        array(
                    'article' => $article
                ));
    }
    /**
     * @Cache(expires="+1 week")
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
     * @Cache(expires="+1 week")
     * @Route("/{id}/album", name="show_album_mobile")
     * @ParamConverter("album", class="FabfotoGalleryBundle:Album")
     * @Template()
     */
    public function showAlbumAction(Album $album)
    {

        $pictures = $this->getAlbumPicture($album);

        return $this->render('FabfotoGalleryBundle:Mobile:ShowAlbum.html.twig',
                        array(
                    'pictures' => $pictures,
                    'album' => $album,
                ));
    }
    /**
     * @Cache(expires="tomorrow")
     * @Route("/{id}/ajaxalbum", name="show_album_mobile_ajax")
     * @ParamConverter("album", class="FabfotoGalleryBundle:Album")
     * @Template()
     */
    public function showAlbumAjaxAction(Album $album)
    {
        $pictures = $this->getAlbumPicture($album);

        return $this->render('FabfotoGalleryBundle:Mobile:ShowAlbumAjax.html.twig',
                        array(
                    'pictures' => $pictures,
                    'album' => $album,
                ));
    }
     /**
      * @Cache(expires="+1 week")
     * @Route("/blog", name="index_blog_mobile")
     */
    public function indexBlogsAction()
    {
        $articlesBlogs = $this->getBlogs();

        return $this->render('FabfotoGalleryBundle:Mobile:IndexArticleBlog.html.twig',
                        array(
                    'articlesBlogs' => $articlesBlogs,
                ));
    }
     /**
     * @Cache(expires="+1 week")
     * @Route("/{slugblog}/blogarticle", name="show_article_blog_mobile")
     * @ParamConverter("article", class="FabfotoGalleryBundle:ArticleBlog")
     */
    public function showBlogArticleAction(ArticleBlog $article)
    {
        if (!$article->getIsPublished()) {
            $this->createNotFoundException();
        }

        return $this->render('FabfotoGalleryBundle:Mobile:ShowArticleBlog.html.twig',
                        array(
                    'article' => $article
                ));
    }

}
