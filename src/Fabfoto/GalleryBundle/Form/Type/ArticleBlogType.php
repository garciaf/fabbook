<?php

namespace Fabfoto\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticleBlogType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('content','jquery_tinymce')
            ->add('author')
            ->add(('tags', 'collection', array(
                'type' => new TagType()
                'allow_add' => true,
                'by_reference' => false,))
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_articleblogtype';
    }
}
