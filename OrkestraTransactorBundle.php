<?php

/*
 * This file is part of OrkestraTransactorBundle.
 *
 * Copyright (c) Orkestra Community
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Orkestra\Bundle\TransactorBundle;

use Doctrine\DBAL\Types\Type;
use Orkestra\Common\DbalType\EncryptedStringType;
use Orkestra\Transactor\DependencyInjection\Compiler\RegisterTransactorsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OrkestraTransactorBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function boot()
    {
        // Register all custom DBAL field types
        $this->registerTypeIfNotRegistered('enum.orkestra.transaction_type',  'Orkestra\Transactor\DbalType\TransactionTypeEnumType');
        $this->registerTypeIfNotRegistered('enum.orkestra.network_type',      'Orkestra\Transactor\DbalType\NetworkTypeEnumType');
        $this->registerTypeIfNotRegistered('enum.orkestra.bank_account_type', 'Orkestra\Transactor\DbalType\AccountTypeEnumType');
        $this->registerTypeIfNotRegistered('enum.orkestra.result_status',     'Orkestra\Transactor\DbalType\ResultStatusEnumType');
        $this->registerTypeIfNotRegistered('orkestra.month',                  'Orkestra\Transactor\DbalType\MonthType');
        $this->registerTypeIfNotRegistered('orkestra.year',                   'Orkestra\Transactor\DbalType\YearType');

        if (!Type::hasType('encrypted_string')) {
            Type::addType('encrypted_string', 'Orkestra\Common\DbalType\EncryptedStringType');
        } elseif (!(Type::getType('encrypted_string') instanceof EncryptedStringType)) {
            throw new \UnexpectedValueException('Type encrypted_string must be instance of Orkestra\Common\DbalType\EncryptedStringType');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RegisterTransactorsPass());
    }

    /**
     * Registers a type with Doctrine DBAL if it is not already registered.
     *
     * This is necessary because multiple instantiations of this bundle will
     * cause an error to be thrown by the DBAL.
     *
     * @param string $typeName
     * @param string $className
     */
    private function registerTypeIfNotRegistered($typeName, $className)
    {
        if (!(Type::hasType($typeName))) {
            Type::addType($typeName, $className);
        }
    }
}
