<?php

namespace Fabfoto\GalleryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('createdAt')
            ->add('content','textarea', array(
                'max_length'=>500,
            ))
            ->add('author')
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_articletype';
    }
}
