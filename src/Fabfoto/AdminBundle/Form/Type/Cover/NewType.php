<?php

namespace Fabfoto\AdminBundle\Form\Type\Cover;

use Admingenerated\FabfotoAdminBundle\Form\BaseCoverType\NewType as BaseNewType;

use Symfony\Component\Form\FormBuilder;

class NewType extends BaseNewType
{
    protected $securityContext;

    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder->add('path', 'file', array('required' => false,));

        $builder->add('name', 'text', array('required' => true,));
    }

}
