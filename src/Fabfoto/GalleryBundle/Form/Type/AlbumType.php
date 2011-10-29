<?php

namespace Fabfoto\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AlbumType extends AbstractType
{

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
                ->add('name')
                ->add('comment','textarea')
                ->add('createdAt','datetime')
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_albumtype';
    }

    public function getDefaultOptions(array $options)
    {
         return array(
            'data_class'      => 'Fabfoto\GalleryBundle\Entity\Album',
        );
    }

}
