<?php

/*
 * This file is part of OrkestratTransactorBundle.
 *
 * Copyright (c) Orkestra Community
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Orkestra\Bundle\TransactorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\DBAL\Types\Type;
use Orkestra\Transactor\DependencyInjection\Compiler\RegisterTransactorsPass;

class OrkestraTransactorBundle extends Bundle
{
    public function boot()
    {
        // Register all custom DBAL field types
        Type::addType('enum.orkestra.transaction_type',  'Orkestra\Transactor\DbalType\TransactionTypeEnumType');
        Type::addType('enum.orkestra.network_type',      'Orkestra\Transactor\DbalType\NetworkTypeEnumType');
        Type::addType('enum.orkestra.bank_account_type', 'Orkestra\Transactor\DbalType\AccountTypeEnumType');
        Type::addType('enum.orkestra.result_status',     'Orkestra\Transactor\DbalType\ResultStatusEnumType');
        Type::addType('orkestra.month',                  'Orkestra\Transactor\DbalType\MonthType');
        Type::addType('orkestra.year',                   'Orkestra\Transactor\DbalType\YearType');
    }

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RegisterTransactorsPass());
    }
}
