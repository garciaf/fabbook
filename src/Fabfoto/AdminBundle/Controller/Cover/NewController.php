<?php

namespace Fabfoto\AdminBundle\Controller\Cover;

use Admingenerated\FabfotoAdminBundle\BaseCoverController\NewController as BaseNewController;

class NewController extends BaseNewController {

    /* This method is here to make your life better, so overwrite  it
    *
    * @param \Symfony\Component\Form\Form $form the valid form
    * @param \Fabfoto\GalleryBundle\Entity\Cover $Cover your \Fabfoto\GalleryBundle\Entity\Cover object
    */
    public function preSave(\Symfony\Component\Form\Form $form, \Fabfoto\GalleryBundle\Entity\Cover $Cover)
    {
        $this->get('fabfoto_gallery.picture_uploader')->upload($Cover, true);
    }
    
}
