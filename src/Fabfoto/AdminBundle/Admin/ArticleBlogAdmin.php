<?php

namespace Fabfoto\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class ArticleBlogAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('subtitle')
            ->add('createdAt')     
            ->add('content','jquery_tinymce')
            ->add('author') 
            ->add('tags','entity', array(
            'class'=>'FabfotoGalleryBundle:Tag',
            'multiple' => true,
            'required' => false,
            ))
            
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('subtitle')
            ->add('author')                 
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('subtitle')
            ->add('createdAt')     
            ->add('author')
        ;
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('title')
                ->assertMaxLength(array('limit' => 255))
            ->end()
        ;
    }
}
?>
