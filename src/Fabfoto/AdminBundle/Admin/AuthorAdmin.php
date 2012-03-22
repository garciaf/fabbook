<?php

namespace Fabfoto\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class AuthorAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('firstname')
                ->add('title')
                ->add('description')
                ->add('phone')
                ->add('googleLink', 'text',
                        array(
                    'required' => false
                ))
                ->add('facebookLink', 'text',
                        array(
                    'required' => false
                ))
                ->add('gitHubLink', 'text',
                        array(
                    'required' => false
                ))
                ->add('linkedLink', 'text',
                        array(
                    'required' => false
                ))
                ->add('twitterLink', 'text',
                        array(
                    'required' => false
                ))
                ->add('mail', 'text',
                        array(
                    'required' => false
                ))
            
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('firstname')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('firstname')     
            ->add('title')
            ->add('mail')
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
