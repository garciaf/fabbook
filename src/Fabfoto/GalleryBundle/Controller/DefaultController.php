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
     */
    public function showArticlesAction()
    {
        $articles = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->findBy(array(), array('createdAt'=> 'DESC'));
        return $this->render('FabfotoGalleryBundle:Default:IndexArticle.html.twig',
                        array(
                    'articles' => $articles
                ));
    }
     /**
     * @Route("blog", name="index_blog")
     */
    public function indexBlogsAction()
    {
        $articlesBlogs = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findBy(array(), array('createdAt'=> 'DESC'));
        return $this->render('FabfotoGalleryBundle:Default:IndexArticleBlog.html.twig',
                        array(
                    'ArticlesBlogs' => $articlesBlogs,
                ));
    }
    
     /**
     * @Route("/{slugblog}/blogarticle", name="show_article_blog")
     */
    public function showBlogArticleAction($slugblog)
    {
        $article = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findOneBySlugblog($slugblog);
        return $this->render('FabfotoGalleryBundle:Default:ShowArticleBlog.html.twig',
                        array(
                    'article' => $article
                ));
    }
    /**
     * @Route("/{tag_slug}/tag/blogarticle", name="show_articles_blog_by_tags")
     */
    public function showBlogArticleByTagAction($tag_slug)
    {
        $tag = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Tag')
                ->findOneBySlug($tag_slug);
        $articlesBlogs = $tag->getArticles();

        return $this->render('FabfotoGalleryBundle:Default:IndexTagArticleBlog.html.twig',
                        array(
                    'ArticlesBlogs' => $articlesBlogs,
                    'tag' => $tag,
                ));
    }
     /**
     * @Route("albums", name="index_album")
     */
    public function indexAlbumsAction()
    {
        if(!$this->testIsOnlyOneAlbum()){
        $albums = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->findBy(array(), array('createdAt'=> 'DESC'));
        return $this->render('FabfotoGalleryBundle:Default:indexAlbum.html.twig',
                        array('albums' => $albums));
        }else{
            $album = $this
                    ->getDoctrine()
                    ->getRepository('FabfotoGalleryBundle:Album')
                    ->findOneBy(array());
            $pictures = $this
                    ->getDoctrine()
                    ->getRepository('FabfotoGalleryBundle:Picture')
                    ->findByIsBackground(false);
            $backgrounds = $this
                    ->getDoctrine()
                    ->getRepository('FabfotoGalleryBundle:Picture')
                    ->findByIsBackground(true);
            return $this->render('FabfotoGalleryBundle:Default:ShowAlbum.html.twig',
                        array(
                    'pictures' => $pictures,
                    'album' => $album,
                    'backgrounds' => $backgrounds
                ));
        }
    }
    /**
     * @Route("rss", name="rss_news")
     */
    public function rssNewsAction()
    {
        $articles = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->findBy(array(), array('createdAt'=> 'DESC'));
        return $this->render('FabfotoGalleryBundle:Default:RSSNews.xml.twig',
                        array('articles' => $articles));
    }

    /**
     * @Route("{slug}/album", name="show_album")
     */
    public function showAlbumAction($slug)
    {
        $album = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->findOneBySlug($slug);
        $pictures = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Picture')
                ->findBy(array(
            'album' => $album->getId(),
            'isBackground' => false
                ));
        $backgrounds = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Picture')
                ->findBy(array(
            'album' => $album->getId(),
            'isBackground' => true
                ));
        
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
        shuffle($backgrounds);
        return $this->render('FabfotoGalleryBundle:Default:BackgroundVegas.html.twig',
                        array(
                    'backgrounds' => $backgrounds
                ));
    }

    /**
     * @Route("search", name="fabfoto_search")
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
    
    private function getAlbumBackground($id){
                return $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Picture')
                ->findBy(array(
            'album' => $id,
            'isBackground' => true
                ));
    }
    
    private function testIsOnlyOneAlbum(){
        $albums = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->findBy(array());
       $nbAlbums = count($albums);
        if($nbAlbums <= 1)
            {
            return true;
        }else
            {
            return false;
        }
    }
}
