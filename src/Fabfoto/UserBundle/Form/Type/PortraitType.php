<?php

namespace Fabfoto\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PortraitType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('location', 'file',array(
                'required'=> true,
                ))
        ;
    }

    public function getName()
    {
        return 'fabfoto_userbundle_portraittype';
    }
}
