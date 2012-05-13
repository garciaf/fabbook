<?php

namespace Fabfoto\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticleBlogType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
	   $builder->add('isPublished', 'checkbox', array(  'required' => false,));

        
           $builder->add('title', 'text', array(  'required' => true,));

        
           $builder->add('subtitle', 'text', array(  'required' => true,));

        
           $builder->add('content', 'genemu_tinymce', array(  'required' => false,));

        
           $builder->add('tags', 'genemu_jquerychosen', array(  'required' => false,  'class' => 'FabfotoGalleryBundle:Tag',  'multiple' => true,  'widget' => 'entity',));

        
           $builder->add('cover', 'genemu_jquerychosen', array(  'required' => false,  'class' => 'FabfotoGalleryBundle:Cover',  'widget' => 'entity',));

        	
    }

    public function getName()
    {
        return 'fabfoto_userbundle_articleblogtype';
    }
}
