<?php

namespace Fabfoto\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ImportType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('path', 'file',array(
                'required'=> false,
                ))
        ;
    }

    public function getName()
    {
        return 'fabfoto_userbundle_portraittype';
    }
}
