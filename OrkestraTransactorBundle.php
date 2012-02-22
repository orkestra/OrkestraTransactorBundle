<?php

namespace Orkestra\TransactorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Doctrine\DBAL\Types\Type;

class OrkestraTransactorBundle extends Bundle
{
    public function boot()
    {
        Type::addType('enum.orkestra.transaction_type', 'Orkestra\Transactor\DBAL\Types\TransactionTypeEnumType');
        Type::addType('orkestra.month', 'Orkestra\Transactor\DBAL\Types\MonthType');
        Type::addType('orkestra.year', 'Orkestra\Transactor\DBAL\Types\YearType');
    }
}
