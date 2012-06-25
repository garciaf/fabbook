<?php

namespace Fabfoto\GalleryBundle\Entity;

use Doctrine\ORM\EntityRepository as EntityRepository;

class AlbumRepository extends EntityRepository
{

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
