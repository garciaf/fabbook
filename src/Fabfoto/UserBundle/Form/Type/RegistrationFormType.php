<?php

namespace Fabfoto\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('name', 'text', array(
                'label' => 'name'
            ))
            ->add('firstname', 'text', array(
                'label' => 'firstname'
            ))
        ;
    }

    public function getName()
    {
        return 'fabfoto_user_registration';
    }
}
