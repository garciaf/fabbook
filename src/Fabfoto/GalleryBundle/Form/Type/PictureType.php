<?php

namespace Fabfoto\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('location', 'file',array(
                'required'=> false,
                ))
            ->add('isBackground','checkbox',array(
                'label'     => 'Mettre cette image en fond ?',
                'required'=> false,

                ))
            ->add('album', 'entity', array('class'=>'FabfotoGalleryBundle:Album'))
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_picturetype';
    }
}
