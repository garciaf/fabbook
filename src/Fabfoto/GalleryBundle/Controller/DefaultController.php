<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Fabfoto\GalleryBundle\Entity\Album  as Album;
use Fabfoto\GalleryBundle\Entity\Category as Category;
class DefaultController extends BaseController
{

    /**
     * @Route("/news", name="show_articles")
     */
    public function showHomePageAction()
    {
        $articlesQuery = $this->getNewsQuery();
        $articlesBlog = $this->getBlogs($this->container->getParameter('nbArticle'));
        $albums = $this->getAlbums($this->container->getParameter('nbAlbum'));

        return $this->render('FabfotoGalleryBundle:Default:Home.html.twig', array(
                    'articles' => $this->getPager($articlesQuery),
                    'lastBlogs' => $articlesBlog,
                    'lastAlbums' => $albums
                ));
    }

    /**
     * @Route("blog", name="index_blog")
     */
    public function indexBlogsAction()
    {
        $articlesBlogsQuery = $this->getBlogsQuery();

        $articlesBlog = $this->getBlogs($this->container->getParameter('nbArticle'));
                

        return $this->render('FabfotoGalleryBundle:Default:IndexArticleBlog.html.twig', array(
                    'ArticlesBlogs' => $this->getPager($articlesBlogsQuery),
                    'lastBlogs' => $articlesBlog
                ));
    }

    /**
     * @Route("/{slugblog}/blogarticle", name="show_article_blog")
     */
    public function showBlogArticleAction($slugblog)
    {
        $article = $this->getBlog($slugblog);

        if (!$article) {
            throw $this->createNotFoundException("No article");
        }

        return $this->render('FabfotoGalleryBundle:Default:ShowArticleBlog.html.twig', array(
                    'article' => $article
                ));
    }

    /**
     * @Route("/{tag_slug}/tag/blogarticle", name="show_articles_blog_by_tags")
     */
    public function showBlogArticleByTagAction($tag_slug)
    {
        $tag = $this->getTag($tag_slug);
        if (!$tag) {
            throw $this->createNotFoundException("no tag");
        }
        $articlesBlogs = $this->getBlogs(null, $tag);

        return $this->render('FabfotoGalleryBundle:Default:IndexTagArticleBlog.html.twig', array(
                    'ArticlesBlogs' => $articlesBlogs,
                    'tag' => $tag,
                ));
    }

    /**
     * @Route("albums", name="index_album")
     */
    public function indexAlbumsAction()
    {
        if (!$this->testIsOnlyOneAlbum()) {
            $albumsQuery = $this->getAlbumsQuery();

            return $this->render('FabfotoGalleryBundle:Default:indexAlbum.html.twig', array('albums' => $this->getPager($albumsQuery)));
        } else {
            $album = $this->getAlbums(1);
            $pictures = $this->getAlbumPicture($album);
            $backgrounds = $this->getAlbumPicture($album, true);
 
            return $this->render('FabfotoGalleryBundle:Default:ShowAlbum.html.twig', array(
                        'pictures' => $pictures,
                        'album' => $album,
                        'backgrounds' => $backgrounds
                    ));
        }
    }

    /**
     * @var $album Album 
     * @var $category Category 
     * @Route("{slug}/album", name="show_album")
     */
    public function showAlbumAction($slug)
    {
        $album = $this->getAlbum($slug);
        if (!$album) {
            throw $this->createNotFoundException("no tag");
        }
        $pictures = $this->getAlbumPicture($album, false, true);

        $backgrounds = $this->getAlbumPicture($album, true);
        
        $template = "FabfotoGalleryBundle:Default:ShowAlbum.html.twig";
        
        $category = $album->getCategory();
        if($category ){
            if($category->getSlug() == $this->container->getParameter('slugNoteCategory') ) {
                $template = "FabfotoGalleryBundle:Default:ShowNoteBook.html.twig";
            } else if($category->getSlug() == $this->container->getParameter('slugAlbumCategory') ){
                $template = "FabfotoGalleryBundle:Default:ShowAlbum.html.twig";
            }
            
        }

        return $this->render($template, 
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
        shuffle($backgrounds);

        return $this->render('FabfotoGalleryBundle:Default:BackgroundVegas.html.twig', array(
                    'backgrounds' => $backgrounds
                ));
    }

    /**
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
