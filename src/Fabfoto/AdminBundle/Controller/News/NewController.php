<?php

namespace Fabfoto\AdminBundle\Controller\News;

use Admingenerated\FabfotoAdminBundle\BaseNewsController\NewController as BaseNewController;

class NewController extends BaseNewController
{
        /**
    * This method is here to make your life better, so overwrite  it
    *
    * @param \Symfony\Component\Form\Form $form the valid form
    * @param \Fabfoto\GalleryBundle\Entity\Article $Article your \Fabfoto\GalleryBundle\Entity\Article object
    */
    public function preSave(\Symfony\Component\Form\Form $form, \Fabfoto\GalleryBundle\Entity\Article $Article)
    {
        $Article->setAuthor($this->get('security.context')->getToken()->getUser());
    }
}
