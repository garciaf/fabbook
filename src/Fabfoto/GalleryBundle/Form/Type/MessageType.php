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
                'label' => 'message.email',
                'required' => true,
                'attr' => array('class' => 'control-label input-xlarge'),
            ))
            ->add('subject', 'text', array(
                'label' => 'message.subject',
                'max_length' => 120,
                'required' => true,
                'attr' => array('class' => 'control-label input-xlarge'),
            ))
            ->add('content', 'textarea', array(
                'label' => 'message.content',
                'required' => true,
                'attr' => array('class' => 'control-label input-xlarge'),
            ))
           ->add('captcha', 'genemu_recaptcha',array(
               "property_path" => false,
               'attr' => array('class' => 'control-label input-xlarge'),
               ))
        ;
    }

    public function getName()
    {
        return 'fabfoto_gallerybundle_messagetype';
    }
}
