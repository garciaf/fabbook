<?php

namespace Fabfoto\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('name')
            ->add('firstname')
            ->add('title')
            ->add('description', 'genemu_tinymce', array(  'required' => false))
            ->add('googleLink')
            ->add('facebookLink')
            ->add('gitHubLink')
            ->add('linkedLink')
            ->add('viadeoLink')
            ->add('twitterLink')
            ->add('phone')
            ->add('mobile')
        ;
    }

    public function getName()
    {
        return 'fabfoto_userbundle_usertype';
    }
}
