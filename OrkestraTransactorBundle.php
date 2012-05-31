<?php

namespace Orkestra\Bundle\TransactorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\DBAL\Types\Type;

class OrkestraTransactorBundle extends Bundle
{
    public function boot()
    {
        Type::addType('enum.orkestra.network_type', 'Orkestra\Transactor\DBAL\Types\NetworkTypeEnumType');
        Type::addType('enum.orkestra.transaction_type', 'Orkestra\Transactor\DBAL\Types\TransactionTypeEnumType');
        Type::addType('enum.orkestra.bank_account_type', 'Orkestra\Transactor\DBAL\Types\AccountTypeEnumType');
        Type::addType('enum.orkestra.result_type', 'Orkestra\Transactor\DBAL\Types\ResultTypeEnumType');
        Type::addType('orkestra.month', 'Orkestra\Transactor\DBAL\Types\MonthType');
        Type::addType('orkestra.year', 'Orkestra\Transactor\DBAL\Types\YearType');
    }
}
