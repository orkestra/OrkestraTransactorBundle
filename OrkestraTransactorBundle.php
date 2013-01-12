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
        Type::addType('enum.orkestra.transaction_type', 'Orkestra\Transactor\DBAL\Types\TransactionTypeEnumType');
        Type::addType('enum.orkestra.network_type', 'Orkestra\Transactor\DBAL\Types\NetworkTypeEnumType');
        Type::addType('enum.orkestra.bank_account_type', 'Orkestra\Transactor\DBAL\Types\AccountTypeEnumType');
        Type::addType('enum.orkestra.result_status', 'Orkestra\Transactor\DBAL\Types\ResultStatusEnumType');
        Type::addType('orkestra.month', 'Orkestra\Transactor\DBAL\Types\MonthType');
        Type::addType('orkestra.year', 'Orkestra\Transactor\DBAL\Types\YearType');
    }

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RegisterTransactorsPass());
    }
}
