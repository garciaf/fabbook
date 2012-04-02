<?php

namespace Fabfoto\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
            ->add('name')
            ->add('firstname')
            ->add('slug')
            ->add('mail')
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
        return 'fabfoto_userbundle_usertype';
    }
}
