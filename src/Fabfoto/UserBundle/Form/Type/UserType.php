<?php

namespace Fabfoto\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Fabfoto\UserBundle\Form\Type\PortraitType as PortraitType;
class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('name')
            ->add('firstname')
            ->add('title')
            ->add('description', 'genemu_tinymce')
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
