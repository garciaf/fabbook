<?php

namespace Fabfoto\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Fabfoto\GalleryBundle\Entity\Album as Album;
use \Fabfoto\GalleryBundle\Entity\Tag as Tag;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter as PagerAdapter;

abstract class BaseController extends Controller
{
    protected function getNewsQuery() {
        return $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Article')
                ->createQueryBuilder('b')
                ->orderBy('b.createdAt', 'DESC')
                ->getQuery();
    }
    protected function getNews() {
        return $this->getNewsQuery()->execute();
    }
    protected function getAlbumsQuery($max = null)
    {
         $albumsQuery = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Album')
                ->createQueryBuilder('b')
                ->orderBy('b.createdAt', 'DESC');
         if($max){
                $albumsQuery->setMaxResults($max);
         }
                return $albumsQuery->getQuery();
    }
    protected function getAlbums($max = null) {
        return $this->getAlbumsQuery($max)->execute();
    }

    protected function getBlogsQuery($max=null, Tag $tag = null)
    {
        $query = $this
                        ->getDoctrine()
                        ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                        ->createQueryBuilder('b');
                        
                        
        if($tag){
            $query
                ->leftJoin('b.tags', 't')
                ->where('b.isPublished = true AND t.slug = :tagSlug')
                ->setParameter('tagSlug', $tag->getSlug());

        }else{
            $query->where('b.isPublished = true');
        }
        $query->orderBy('b.createdAt', 'DESC');
        if($max) {
        $query->setMaxResults($max);
        
        }
        return $query->getQuery();
    }
    
    protected function getBlogs($max = null,Tag $tag = null) {
        return $this->getBlogsQuery($max, $tag)->execute();
    }

    protected function getPager($query)
    {
        $Currentpage = 1;
        if ($this->get("request")->query->get('page')) {
            $Currentpage = $this->get("request")->query->get('page');
        }

        $paginator = new Pagerfanta(new PagerAdapter($query));
        $paginator->setMaxPerPage(9);
        $paginator->setCurrentPage($Currentpage, false, true);

        return $paginator;
    }

    protected function getBlog($slugblog)
    {
        return $this
                        ->getDoctrine()
                        ->getRepository('FabfotoGalleryBundle:ArticleBlog')
                        ->findOneBySlugblog($slugblog);
    }

    protected function getTag($tag_slug)
    {
        return $this
                        ->getDoctrine()
                        ->getRepository('FabfotoGalleryBundle:Tag')
                        ->findOneBySlug($tag_slug);
    }

    public function getAlbum($slug)
    {
        return $this
                        ->getDoctrine()
                        ->getRepository('FabfotoGalleryBundle:Album')
                        ->findOneBySlug($slug);
        
    }

    protected function getAlbumPicture(Album $album, $isBackground = false, $orderByName = false)
    {

        $query = $this
                ->getDoctrine()
                ->getRepository('FabfotoGalleryBundle:Picture')
                ->createQueryBuilder('p')
                ->where('p.album = :idAlbum AND p.isBackground = :isBackground')
                ->setParameter('idAlbum', $album->getId())
                ->setParameter('isBackground', $isBackground);
        if($orderByName){
            $query->orderBy('p.name', 'ASC');
        }
        return $query->getQuery()
                ->execute();
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

}
