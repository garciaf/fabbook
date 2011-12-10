<?php

namespace Fabfoto\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticleBlogType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('createdAt','jquery_date', array('format' => 'dd/MM/y'))
            ->add('updatedAt','jquery_date', array('format' => 'dd/MM/y'))
            ->add('title')
            ->add('subtitle')
            ->add('content','jquery_tinymce')
            ->add('author')
            ->add('tags','entity', array(
                'class'=>'FabfotoGalleryBundle:Tag',
                'multiple' => true,
                'required' => false,
                )
                )
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_articleblogtype';
    }
}
