<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RSSController extends BaseController
{
    /**
     * @Cache(expires="+6 hours")
     * @Route("rss", defaults={"_format"="xml"}, name="rss_news")
     */
    public function rssNewsAction()
    {
        $news = $this->getNews();

        return $this->render('FabfotoGalleryBundle:RSS:RSSNews.xml.twig', array('news' => $news));
    }
    /**
     * @Cache(expires="tomorrow")
     * @Route("rss/blog", defaults={"_format"="xml"}, name="rss_blog")
     */
    public function rssBlogAction()
    {
        $articles = $this->getBlogs();

        return $this->render('FabfotoGalleryBundle:RSS:RSSBlog.xml.twig', array('articles' => $articles));
    }
    /**
     * @Cache(expires="tomorrow")
     * @Route("/feed/rss/album", defaults={"_format"="xml"}, name="rss_album")
     */
    public function rssAlbumAction()
    {
        $albums = $this->getAlbums();

        return $this->render('FabfotoGalleryBundle:RSS:RSSAlbum.xml.twig', array('albums' => $albums));
    }
    /**
     * @Cache(expires="tomorrow")
     * @Route("rss/{tag_slug}/blog", defaults={"_format"="xml"}, name="rss_blog_tag")
     */
    public function showBlogArticleAction($tag_slug)
    {
        $tag = $this->getTag($tag_slug);

        if (!$tag) {
            throw $this->createNotFoundException("no tag");
        }
        $articles = $this->getBlogs(null, $tag);

        return $this->render('FabfotoGalleryBundle:RSS:RSSBlogTag.xml.twig', array(
                    'articles' => $articles,
                    'tag' => $tag,
                ));
    }
}
