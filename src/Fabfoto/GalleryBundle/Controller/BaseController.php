<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Fabfoto\GalleryBundle\Entity\Album as Album;
use \Fabfoto\GalleryBundle\Entity\Tag as Tag;
use \Fabfoto\GalleryBundle\Entity\Article as Article;
use \Fabfoto\UserBundle\Entity\User as User;
use \Fabfoto\GalleryBundle\Entity\Picture as Picture;
use \Fabfoto\GalleryBundle\Entity\ArticleBlog as ArticleBlog;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter as PagerAdapter;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends Controller
{
    protected function getNewsQuery($max = null)
    {
        return $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->getQueryOrderBydate($max);
    }
    protected function getNews($max = null)
    {
        return $this->getNewsQuery($max)->execute();
    }

    protected function getLastNews()
    {
        $lastNews = $this->getNewsQuery(1)->getSingleResult();
        if ($lastNews) {
            return $lastNews;
        } else {
            return new Article();
        }
    }

    protected function getLastPictureAdded()
    {
        $lastPicture =  $this->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Picture')
                ->findLastPicture();
        if ($lastPicture) {
            return $lastPicture;
        } else {
            return new Picture();
        }
    }
    protected function getAlbumsQuery($max = null)
    {
         return $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->getQueryOrderByCreatedAt($max);
    }
    protected function getAlbums($max = null)
    {
        return $this->getAlbumsQuery($max)->execute();
    }

    protected function getBlogsQuery($max=null, Tag $tag = null)
    {
        $query = $this
                        ->getDoctrine()
                        ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                        ->createQueryBuilder('b');

        if ($tag) {
            $query
                ->leftJoin('b.tags', 't')
                ->where('b.isPublished = true AND t.slug = :tagSlug')
                ->setParameter('tagSlug', $tag->getSlug());

        } else {
            $query->where('b.isPublished = true');
        }
        $query->orderBy('b.createdAt', 'DESC');
        if ($max) {
        $query->setMaxResults($max);

        }

        return $query->getQuery();
    }

    protected function getBlogs($max = null,Tag $tag = null)
    {
        return $this->getBlogsQuery($max, $tag)->execute();
    }

    protected function getPager($query, $maxPerPage = 9)
    {
        $Currentpage = 1;
        if ($this->get("request")->query->get('page')) {
            $Currentpage = $this->get("request")->query->get('page');
        }

        $paginator = new Pagerfanta(new PagerAdapter($query));
        $paginator->setMaxPerPage($maxPerPage);
        $paginator->setCurrentPage($Currentpage, false, true);

        return $paginator;
    }

    protected function getBlog($slugblog, $isPublished = true)
    {
        return $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->findOneBy(array('slugblog' => $slugblog, 'isPublished' => $isPublished ));
    }

    protected function getLastUpdatedBlog()
    {
        $lastBlog =  $this->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                ->getQueryOrderByUpdatedAt(1)
                ->getSingleResult();
        if ($lastBlog) {
            return $lastBlog;
        } else {
            return new ArticleBlog();
        }
    }

    /**
     *
     * @param  string $tag_slug
     * @return Tag
     */
    protected function getTag($tag_slug)
    {
        return $this
                        ->getDoctrine()
                        ->getRepository('FabfotoGalleryBundle:Tag')
                        ->findOneBySlug($tag_slug);
    }
    /**
     * To get an album by slug name
     * @param  string $slug
     * @return Album
     */
    public function getAlbumBySlug($slug)
    {
        return $this
                        ->getDoctrine()
                        ->getRepository('FabfotoGalleryBundle:Album')
                        ->findOneBySlug($slug);

    }
    public function getAlbumById($id)
    {
        return $this
                        ->getDoctrine()
                        ->getRepository('FabfotoGalleryBundle:Album')
                        ->find($id);

    }
    /**
     *
     * @param  Album $album
     * @param  type  $isBackground
     * @param  type  $orderByName
     * @return type
     */
    protected function getAlbumPicture(Album $album= null, $isBackground = false, $orderByName = true)
    {

        $query = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Picture')
                ->createQueryBuilder('p');
        if ($album) {
                $query->where('p.album = :idAlbum AND p.isBackground = :isBackground')
                ->setParameter('idAlbum', $album->getId())
                ->setParameter('isBackground', $isBackground);
        } else {
            $query->where('p.isBackground = :isBackground')
             ->setParameter('isBackground', $isBackground);
        }
        if ($orderByName) {
            $query->orderBy('p.name', 'ASC');
        }

        return $query->getQuery()
                ->execute();
    }
    protected function getUserBySlug($slug)
    {
        return $this
                ->getDoctrine()
                ->getRepository('FabfotoUserBundle:User')
                ->findOneBy(array(
            'slug' => $slug
                ));
    }
    protected function testIsOnlyOneAlbum()
    {
        $albums = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->findBy(array());
        $nbAlbums = count($albums);
        if ($nbAlbums <= 1) {
            return true;
        } else {
            return false;
        }
    }

    protected function getVcardOfUser(User $user)
    {
        return $this->renderView('FabfotoGalleryBundle:Vcard:ShowAbout.vcf.twig', array(
            'user' => $user
                ));

    }
    /**
     * Get a response with a header to use cache
     *
     * @param  \DateTime                                  $lastUpdated
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResponseHeader(\DateTime $lastUpdated)
    {
        // create a Response with a ETag and/or a Last-Modified header
        $response = new Response();
        $response->setLastModified($lastUpdated);
        $response->setMaxAge(3600*24*7);
        // Set response as public. Otherwise it will be private by default.
        $response->setPublic();

        return $response;
    }

    /**
     * Return the current user
     * @return User
     */
    protected function getCurrentUser()
    {
        return $this->get('security.context')->getToken()->getUser();
    }
}
