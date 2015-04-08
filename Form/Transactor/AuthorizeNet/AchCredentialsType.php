<?php

/*
 * This file is part of OrkestraTransactorBundle.
 *
 * Copyright (c) Orkestra Community
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Orkestra\Bundle\TransactorBundle\Form\Transactor\AuthorizeNet;

use Symfony\Component\Form\FormBuilderInterface;
use Orkestra\Bundle\TransactorBundle\Form\AbstractCredentialsType;

/**
 * Credentials form type for the Network Merchants Card Transactor
 */
class AchCredentialsType extends CardCredentialsType
{
    /**
     * Gets the internal type of the associated Transactor
     *
     * @return string
     */
    protected function getTransactorType()
    {
        return 'orkestra.authorize_net.ach';
    }
}
