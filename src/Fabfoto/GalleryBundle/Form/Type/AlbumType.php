<?php

namespace Fabfoto\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AlbumType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name')
                ->add('comment','textarea')
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
