<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RSSController extends Controller
{
    /**
     * @Route("rss", defaults={"_format"="xml"}, name="rss_news")
     */
    public function rssNewsAction()
    {
        $articles = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->findBy(array(), array('createdAt' => 'DESC'));

        return $this->render('FabfotoGalleryBundle:RSS:RSSNews.xml.twig', array('articles' => $articles));
    }
    /**
     * @Route("rss/blog", defaults={"_format"="xml"}, name="rss_blog")
     */
    public function rssBlogAction()
    {
        $articles = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findBy(array('isPublished' => true), array('createdAt' => 'DESC'));

        return $this->render('FabfotoGalleryBundle:RSS:RSSBlog.xml.twig', array('articles' => $articles));
    }
    /**
     * @Route("/feed/rss/album", defaults={"_format"="xml"}, name="rss_album")
     */
    public function rssAlbumAction()
    {
        $albums = $this
                    ->getDoctrine()
                    ->getRepository('FabfotoGalleryBundle:Album')
                    ->createQueryBuilder('b')
                    ->orderBy('b.createdAt', 'DESC')
                    ->getQuery()
                    ->execute();

        return $this->render('FabfotoGalleryBundle:RSS:RSSAlbum.xml.twig', array('albums' => $albums));
    }
    /**
     * @Route("rss/{tag_slug}/blog", defaults={"_format"="xml"}, name="rss_blog_tag")
     */
    public function showBlogArticleAction($tag_slug)
    {
        $tag = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Tag')
                ->findOneBySlug($tag_slug);
        if (!$tag) {
            throw $this->createNotFoundException("no tag");
        }
        $articles = $this
        ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
        ->createQueryBuilder('a')
        ->leftJoin('a.tags', 't')
        ->where('a.isPublished = true AND t.slug = :tagSlug')
        ->setParameter('tagSlug', $tag->getSlug())
                ->orderBy('a.createdAt', 'DESC')
        ->getQuery()
        ->execute();

        return $this->render('FabfotoGalleryBundle:RSS:RSSBlogTag.xml.twig', array(
                    'articles' => $articles,
                    'tag' => $tag,
                ));
    }
}
