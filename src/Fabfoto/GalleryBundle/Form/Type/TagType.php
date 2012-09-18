<?php

namespace Fabfoto\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_tagtype';
    }
}
