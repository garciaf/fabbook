<?php

namespace Fabfoto\GalleryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
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
            ->add('mail')
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_authortype';
    }
}
