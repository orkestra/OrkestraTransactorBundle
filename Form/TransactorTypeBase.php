<?php

namespace Orkestra\TransactorBundle\Form;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilder,
    Symfony\Component\Form\Event\DataEvent;

abstract class TransactorTypeBase extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
                ->add('description', null, array('required' => false))
                ->add('active', null, array('required' => false));
    }
}
