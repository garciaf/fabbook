<?php

namespace Fabfoto\AdminBundle\Controller\Blog;

use Admingenerated\FabfotoAdminBundle\BaseBlogController\NewController as BaseNewController;

class NewController extends BaseNewController
{
    /**
     * This method is here to make your life better, so overwrite  it
     *
     * @param \Symfony\Component\Form\Form              $form        the valid form
     * @param \Fabfoto\GalleryBundle\Entity\ArticleBlog $ArticleBlog your \Fabfoto\GalleryBundle\Entity\ArticleBlog object
     */
    public function preSave(\Symfony\Component\Form\Form $form, \Fabfoto\GalleryBundle\Entity\ArticleBlog $ArticleBlog)
    {
        $curentUser = $this->get('security.context')->getToken()->getUser();
        $ArticleBlog->setAuthorUser($curentUser);
    }

}
