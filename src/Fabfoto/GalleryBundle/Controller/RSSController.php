<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Fabfoto\GalleryBundle\Entity\Tag  as Tag;

class RSSController extends BaseController
{
    /**
     * @Cache(expires="+1 hours")
     * @Route("rss", defaults={"_format"="xml"}, name="rss_news")
     */
    public function rssNewsAction()
    {
        $news = $this->getNews();

        return $this->render('FabfotoGalleryBundle:RSS:RSSNews.xml.twig', array('news' => $news));
    }
    /**
     * @Cache(expires="+1 hours")
     * @Route("rss/blog", defaults={"_format"="xml"}, name="rss_blog")
     */
    public function rssBlogAction()
    {
        $articles = $this->getBlogs();

        return $this->render('FabfotoGalleryBundle:RSS:RSSBlog.xml.twig', array('articles' => $articles));
    }
    /**
     * @Cache(expires="+1 hours")
     * @Route("/feed/rss/album", defaults={"_format"="xml"}, name="rss_album")
     */
    public function rssAlbumAction()
    {
        $albums = $this->getAlbums();

        return $this->render('FabfotoGalleryBundle:RSS:RSSAlbum.xml.twig', array('albums' => $albums));
    }
    /**
     * @Cache(expires="+1 hours")
     * @Route("rss/{slug}/blog", defaults={"_format"="xml"}, name="rss_blog_tag")
     * @ParamConverter("tag", class="FabfotoGalleryBundle:Tag")
     */
    public function showBlogArticleAction(Tag $tag)
    {
        $articles = $this->getBlogs(null, $tag);

        return $this->render('FabfotoGalleryBundle:RSS:RSSBlogTag.xml.twig', array(
                    'articles' => $articles,
                    'tag' => $tag,
                ));
    }
}
