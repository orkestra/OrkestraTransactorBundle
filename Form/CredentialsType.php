<?php

namespace Orkestra\TransactorBundle\Form;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormTypeInterface,
    Symfony\Component\Form\FormBuilder;

class CredentialsType extends AbstractType
{
    protected $_fields;
    
    public function __construct(array $fields)
    {
        $this->_fields = $fields;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        foreach ($this->_fields as $field)
        {
            if (is_array($field)) {
                $name = $field['name'];
                $type = empty($field['type']) ? null : $field['type'];
                $options = empty($field['options']) ? array() : $field['options'];
                
                $builder->add($name, $type, $options);
            }
            else {
                $builder->add($field);
            }
        }
    }
    
    public function getParent(array $options)
    {
        return 'form';
    }

    public function getName()
    {
        return 'orkestra_credentialstype';
    }
}