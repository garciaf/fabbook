<?php

namespace Fabfoto\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('content','jquery_tinymce')
            ->add('author')
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_articletype';
    }
}
