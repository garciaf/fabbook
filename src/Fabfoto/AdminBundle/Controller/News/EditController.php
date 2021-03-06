<?php

namespace Fabfoto\AdminBundle\Controller\News;

use Admingenerated\FabfotoAdminBundle\BaseNewsController\EditController as BaseEditController;

class EditController extends BaseEditController
{
            /**
    * This method is here to make your life better, so overwrite  it
    *
    * @param \Symfony\Component\Form\Form $form the valid form
    * @param \Fabfoto\GalleryBundle\Entity\Article $Article your \Fabfoto\GalleryBundle\Entity\Article object
    */
    public function preSave(\Symfony\Component\Form\Form $form, \Fabfoto\GalleryBundle\Entity\Article $Article)
    {
        $curentUser = $this->get('security.context')->getToken()->getUser();
        $Article->setAuthor($curentUser);
    }
}
