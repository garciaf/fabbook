<?php
namespace Fabfoto\GalleryBundle\Entity;

use Doctrine\ORM\EntityRepository as EntityRepository;

class ArticleRepository extends EntityRepository
{

    public function OrderByDate()
    {
        return $this->queryOrderBydate()->execute();
    }
    private function queryOrderBydate()
    {
        return $this->_em
                        ->createQuery('SELECT s FROM FabfotoGalleryBundle:Article s ORDER BY s.createdAt DESC');
    }
}
