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
                'label' => 'message.email'
            ))
            ->add('subject', 'text', array(
                'label' => 'message.subject',
                'max_length' => 120
            ))
            ->add('content', 'textarea', array(
                'label' => 'message.content'
            ))
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_messagetype';
    }
}
