<?php

/*
 * Copyright (c) 2013 Orkestra Community
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

namespace Orkestra\Bundle\TransactorBundle\Form\Account;

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
