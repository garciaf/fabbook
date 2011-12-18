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

    public function findLastest($limit)
    {
        return $this->queryOrderBydate()->setMaxResults($limit)->execute();
    }
    
    public function findLatestBackground($limit){
    return $this
            ->queryPicturesBackgroung()
            ->setMaxResults($limit)
            ->execute();
    }

    private function queryPicturesBackgroung(){
    return $this->_em
            ->createQuery('SELECT s FROM FabfotoGalleryBundle:Picture WHERE s.isBackground == TRUE');
    }
    private function queryOrderBydate()
    {   
        return $this->_em
                        ->createQuery('SELECT s FROM FabfotoGalleryBundle:Picture s ORDER BY s.createdAt DESC');
    }

}