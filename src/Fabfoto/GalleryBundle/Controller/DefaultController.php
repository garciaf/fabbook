<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\Request;
use Fabfoto\GalleryBundle\Entity\Album as Album;
use Fabfoto\GalleryBundle\Entity\Tag as Tag;
use Fabfoto\GalleryBundle\Entity\ArticleBlog as ArticleBlog;

class DefaultController extends BaseController
{
    public function notificationAction()
    {
        return $this->render('FabfotoGalleryBundle::notification.html.twig');
    }

    public function lastContentAction($noAlbum = false, $noBlog = false)
    {
        $articlesBlog = array();
        $lastAlbums = array();
        if (!$noBlog) {
            $articlesBlog = $this->getBlogs($this->container->getParameter('nbArticle'));
        }
        if (!$noAlbum) {
            $lastAlbums = $this->getAlbums($this->container->getParameter('nbAlbum'));
        }

        return $this->render('FabfotoGalleryBundle:Default:LastContent.html.twig', array(
                    'lastBlogs' => $articlesBlog,
                    'lastAlbums' => $lastAlbums
                ));
    }

    /**
     * @Route("/news", name="show_articles")
     */
    public function showHomePageAction()
    {
        $lastNews = $this->getLastNews();
    $response = $this->getResponseHeader($lastNews->getUpdatedAt());

        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;
        } else {
        $articlesQuery = $this->getNewsQuery();

        return $this->render('FabfotoGalleryBundle:Default:Home.html.twig', array(
                    'articles' => $this->getPager($articlesQuery, 4),
                ), $response);
        }
    }

    /**
     *
     * @Route("blog", name="index_blog")
     */
    public function indexBlogsAction()
    {
        $lastBlog= $this->getLastUpdatedBlog();
        $response = $this->getResponseHeader($lastBlog->getUpdatedAt());
        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;
        } else {
        $articlesBlogsQuery = $this->getBlogsQuery();

        return $this->render('FabfotoGalleryBundle:Default:IndexArticleBlog.html.twig', array(
                    'ArticlesBlogs' => $this->getPager($articlesBlogsQuery),
                ), $response);
        }
    }

    /**
     * @Route("/{slugblog}/blogarticle", name="show_article_blog")
     * @ParamConverter("article", class="FabfotoGalleryBundle:ArticleBlog")
     */
    public function showBlogArticleAction(ArticleBlog $article)
    {
        $response = $this->getResponseHeader($article->getUpdatedAt());
        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;
        } else {

        //If the artcle is not published you can not access to it
        if (!$article->getIsPublished()) {
            $this->createNotFoundException();
        }
        $lastBlogs = $this->getBlogs(3, null, $article);
        return $this->render('FabfotoGalleryBundle:Default:ShowArticleBlog.html.twig', array(
                    'article' => $article, 
                    'ArticlesBlogs'=> $lastBlogs,
                ), $response);
        }
    }

    /**
     * @Route("/{slug}/tag/blogarticle", name="show_articles_blog_by_tags")
     * @ParamConverter("tag", class="FabfotoGalleryBundle:Tag")
     */
    public function showBlogArticleByTagAction(Tag $tag)
    {
        $lastBlog= $this->getLastUpdatedBlog();
        $response = $this->getResponseHeader($lastBlog->getUpdatedAt());
        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;
        } else {
        $articlesBlogs = $this->getBlogs(null, $tag);

        return $this->render('FabfotoGalleryBundle:Default:IndexTagArticleBlog.html.twig', array(
                    'ArticlesBlogs' => $articlesBlogs,
                    'tag' => $tag,
                ), $response);
        }
    }

    /**
     * @Route("albums", name="index_album")
     */
    public function indexAlbumsAction()
    {
        $lastPicture = $this->getLastPictureAdded();
        // If there is no picture the page is not cached
        $response = $this->getResponseHeader($lastPicture->getCreatedAt());

        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;
        } else {

        $albumsQuery = $this->getAlbumsQuery();

        return $this->render('FabfotoGalleryBundle:Default:indexAlbum.html.twig', array(
            'albums' => $this->getPager($albumsQuery)
                ), $response);
        }
    }

    /**
     * @var $album Album
     * @Route("{slug}/album", name="show_album")
     * @ParamConverter("album", class="FabfotoGalleryBundle:Album")
     */
    public function showAlbumAction(Album $album)
    {
        $response = $this->getResponseHeader($album->getUpdatedAt());

        if ($response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            return $response;

        } else {

        $pictures = $this->getAlbumPicture($album, false, true);

        $backgrounds = $this->getAlbumPicture($album, true);

        $template = "FabfotoGalleryBundle:Default:ShowAlbum.html.twig";

        $category = $album->getCategory();
        if ($category) {
            if ($category->getSlug() == $this->container->getParameter('slugNoteCategory')) {
                $template = "FabfotoGalleryBundle:Default:ShowNoteBook.html.twig";
            } elseif ($category->getSlug() == $this->container->getParameter('slugAlbumCategory')) {
                $template = "FabfotoGalleryBundle:Default:ShowAlbum.html.twig";
            }
        }

        return $this->render($template, array(
                    'pictures' => $pictures,
                    'album' => $album,
                    'backgrounds' => $backgrounds
                ), $response);
        }
    }

    public function allBackgroundAction($max)
    {
        $backgrounds = $this->getAlbumPicture(null, true, false);
        shuffle($backgrounds);

        return $this->render('FabfotoGalleryBundle:Default:BackgroundVegas.html.twig', array(
                    'backgrounds' => $backgrounds
                ));
    }

    public function allTagsAction(){

        $tags = $this->getTags();
        
        return $this->render('FabfotoGalleryBundle:Default:Tags.html.twig', array(
                    'tags' => $tags,
                ));
    }

    /**
     * @Cache(expires="tomorrow", public=true)
     * @Route("search", name="fabfoto_search")
     */
    public function searchAction(Request $request)
    {
        $pictures = array();
        $albums = array();
        if ($request->query->get('q')) {
            $pictures = $this
                    ->getDoctrine()
                    ->getRepository('FabfotoGalleryBundle:Picture')
                    ->search($request->query->get('q'));
            $albums = $this
                    ->getDoctrine()
                    ->getRepository('FabfotoGalleryBundle:Album')
                    ->search($request->query->get('q'));
            $articlesBlogs = $this
                    ->getDoctrine()
                    ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                    ->search($request->query->get('q'));
        }

        return $this->render('FabfotoGalleryBundle:Default:SearchResult.html.twig', array(
                    'albums' => $albums,
                    'pictures' => $pictures,
                    'keywords' => $request->query->get('q'),
                    'ArticlesBlogs' => $articlesBlogs,
                        )
        );
    }

}
