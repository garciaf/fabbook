<?php

namespace Fabfoto\AdminBundle\Controller\Picture;

use Admingenerated\FabfotoAdminBundle\BasePictureController\EditController as BaseEditController;

class EditController extends BaseEditController
{
    /**
    * This method is here to make your life better, so overwrite  it
    *
    * @param \Symfony\Component\Form\Form $form the valid form
    * @param \Fabfoto\GalleryBundle\Entity\Picture $Picture your \Fabfoto\GalleryBundle\Entity\Picture object
    */
    public function preSave(\Symfony\Component\Form\Form $form, \Fabfoto\GalleryBundle\Entity\Picture $Picture)
    {
        $this->get('fabfoto_gallery.picture_uploader')->upload($Picture);
    }
}
