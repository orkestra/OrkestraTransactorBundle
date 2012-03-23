<?php

namespace Orkestra\TransactorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TransactorSelectType extends AbstractType
{
    protected static $_transactors = array(
        'NmiCardTransactor' => 'NMI Card Transactor'
    );
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('type', 'choice', array('choices' => self::$_transactors, 'empty_value' => ''));
    }

    public function getName()
    {
        return 'orkestra_transactorselecttype';
    }
}
