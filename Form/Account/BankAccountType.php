<?php

/*
 * This file is part of OrkestraTransactorBundle.
 *
 * Copyright (c) Orkestra Community
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Orkestra\Bundle\TransactorBundle\Form\Account;

use Orkestra\Bundle\ApplicationBundle\Form\EnumType;
use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface;

/**
 * Form Type for BankAccounts
 */
class BankAccountType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('accountNumber', null, array('label' => 'Account Number'))
                ->add('routingNumber', null, array('label' => 'Routing Number', 'required' => true))
                ->add('accountType', EnumType::class, array(
                    'placeholder' => false,
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
