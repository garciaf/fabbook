<?php

namespace Fabfoto\GalleryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('sender','email', array(
                'label' => 'Votre email'
            ))
            ->add('subject', 'text', array(
                'max_length' => 120
            ))
            ->add('content', 'textarea', array(
                
            ))
            ->add('captcha', 'captcha')
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_messagetype';
    }
}
