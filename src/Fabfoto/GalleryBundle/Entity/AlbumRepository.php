<?php

namespace Fabfoto\GalleryBundle\Entity;

use Doctrine\ORM\EntityRepository as EntityRepository;

class AlbumRepository extends EntityRepository
{
    public function findLastAlbums($max)
    {
        return $this->getQueryOrderBydate($max)->execute();
    }

    public function findLastAlbum()
    {
        return $this->getQueryOrderByCreatedAt(1)->getSingleResult();
    }
    public function getQueryOrderByCreatedAt($max = null)
    {
        $query = $this->createQueryBuilder('a')
                ->add('orderBy', 'a.createdAt DESC');
        if ($max) {
            $query->setMaxResults($max);
        }

        return $query->getQuery();
    }
    public function search($keywords)
    {
        return $this
                        ->createQueryBuilder('s')
                        ->where('s.name LIKE :keywords')
                        ->setParameter('keywords', sprintf('%%%s%%', $keywords))
                        ->getQuery()
                        ->execute()
        ;
    }

}
