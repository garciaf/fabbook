<?php

namespace Fabfoto\AdminBundle\Form\Type\Cover;

use Admingenerated\FabfotoAdminBundle\Form\BaseCoverType\EditType as BaseEditType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EditType extends BaseEditType
{
    protected $securityContext;
    
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder->add('path', 'file', array('required' => false,));


        $builder->add('name', 'text', array('required' => true,));
    }
}
