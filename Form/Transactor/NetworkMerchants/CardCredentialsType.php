<?php

/*
 * This file is part of OrkestraTransactorBundle.
 *
 * Copyright (c) Orkestra Community
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Orkestra\Bundle\TransactorBundle\Form\Transactor\NetworkMerchants;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Orkestra\Bundle\TransactorBundle\Form\AbstractCredentialsType;

/**
 * Credentials form type for the Network Merchants Card Transactor
 */
class CardCredentialsType extends AbstractCredentialsType
{
    /**
     * Gets the internal type of the associated Transactor
     *
     * @return string
     */
    protected function getTransactorType()
    {
        return 'orkestra.network_merchants.card';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('username', TextType::class)
            ->add('password', TextType::class);
    }
}
