<?php

namespace Fabfoto\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleBlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
