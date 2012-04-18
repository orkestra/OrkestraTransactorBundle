<?php

namespace Orkestra\TransactorBundle\Form\Account;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilder;

/**
 * Form Type for BankAccounts
 */
class BankAccountType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('accountNumber', null, array('label' => 'Account Number'))
                ->add('routingNumber', null, array('label' => 'Routing Number', 'required' => true))
                ->add('accountType', 'enum', array(
                    'empty_value' => false, 
                    'enum' => 'Orkestra\Transactor\Entity\Account\BankAccount\AccountType', 
                    'label' => 'Account Type'
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions(array $options)
    {
    	return array(
    		'data_class' => 'Orkestra\Transactor\Entity\Account\BankAccount',
    	);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
    	return 'orkestra_transactor_bankaccount';
    }
}
