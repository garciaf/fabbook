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
            ->add('name')
            ->add('firstname')
            ->add('title')
            ->add('description')
            ->add('googleLink')
            ->add('facebookLink')
            ->add('gitHubLink')
            ->add('linkedLink')
            ->add('twitterLink')
            ->add('phone')
        ;
    }

    public function getName()
    {
        return 'fabfoto_user_registration';
    }
}
