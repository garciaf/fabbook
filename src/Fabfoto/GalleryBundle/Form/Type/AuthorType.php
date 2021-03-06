<?php

namespace Fabfoto\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('firstname')
                ->add('title')
                ->add('description')
                ->add('phone')
                ->add('googleLink', 'text',
                        array(
                    'required' => false
                ))
                ->add('facebookLink', 'text',
                        array(
                    'required' => false
                ))
                ->add('gitHubLink', 'text',
                        array(
                    'required' => false
                ))
                ->add('linkedLink', 'text',
                        array(
                    'required' => false
                ))
                ->add('twitterLink', 'text',
                        array(
                    'required' => false
                ))
                ->add('mail', 'text',
                        array(
                    'required' => false
                ))
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_authortype';
    }
}
