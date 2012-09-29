<?php

namespace Fabfoto\GalleryBundle\Entity;

use Doctrine\ORM\EntityRepository as EntityRepository;

class PictureRepository extends EntityRepository
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

    public function findLastest($limit = null, $isBackground = null)
    {
        return $this->getQueryOrderByCreatedAt($limit, $isBackground)->execute();
    }
    public function findLatestBackground($limit = null)
    {
    return $this->findLastest($limit, true);
    }

    public function findLastPicture()
    {
        return $this->getQueryOrderByCreatedAt(1)->getSingleResult();
    }
    public function getQueryOrderByCreatedAt( $max = null, $isBackground = null)
    {
        $query = $this->createQueryBuilder('p')
                ->add('orderBy', 'p.createdAt DESC');
        if (!is_null($isBackground)) {
            $query->where('p.isBackground = :isBackground')->setParameter("isBackground", $isBackground);
        }
        if ($max) {
            $query->setMaxResults($max);
        }

        return $query->getQuery();
    }
}
