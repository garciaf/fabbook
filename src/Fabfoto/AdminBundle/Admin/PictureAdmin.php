<?php

namespace Fabfoto\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class PictureAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('location', 'file',array(
                'required'=> false,
                ))
            ->add('createdAt', 'jquery_date', array('format' => 'dd/MM/y'))
            ->add('isBackground','checkbox',array(
                'label'     => 'Mettre cette image en fond ?',
                'required'=> false,

                ))    
            ->add('album', 'entity', array('class'=>'FabfotoGalleryBundle:Album'))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('isBackground')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('createdAt')
            ->add('album')
            ->add('isBackground')
        ;
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('name')
                ->assertMaxLength(array('limit' => 255))
            ->end()
        ;
    }
}
?>
