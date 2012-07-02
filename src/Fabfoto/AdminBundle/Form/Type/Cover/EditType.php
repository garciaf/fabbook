<?php

namespace Fabfoto\AdminBundle\Form\Type\Cover;

use Admingenerated\FabfotoAdminBundle\Form\BaseCoverType\EditType as BaseEditType;

use Symfony\Component\Form\FormBuilder;

class EditType extends BaseEditType
{
    protected $securityContext;

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text', array('required' => true,));
    }
}
