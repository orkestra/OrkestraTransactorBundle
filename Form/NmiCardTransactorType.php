<?php

namespace Orkestra\TransactorBundle\Form;

use Symfony\Component\Form\FormBuilder;    

class NmiCardTransactorType extends TransactorTypeBase
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $credentialsType = new CredentialsType(array(
            'username', 
            'password',
        ));
        
        $builder->add('credentials', $credentialsType);
    }
    
    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Orkestra\Transactor\Entity\Transactor\NmiCardTransactor');
    }

    public function getName()
    {
        return 'orkestra_nmicardtranactortype';
    }
}
