<?php

/*
 * This file is part of OrkestraTransactorBundle.
 *
 * Copyright (c) Orkestra Community
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Orkestra\Bundle\TransactorBundle\Tests;

use Orkestra\Bundle\TransactorBundle\OrkestraTransactorBundle;
use Orkestra\Transactor\DependencyInjection\Compiler\RegisterTransactorsPass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OrkestraTransactorBundleTest extends \PHPUnit_Framework_TestCase
{
    private $originalTypesMap;

    public function testBoot()
    {
        $bundle = new OrkestraTransactorBundle();
        $bundle->boot();

        $typesMap = \Doctrine\DBAL\Types\Type::getTypesMap();

        $this->assertEquals('Orkestra\Transactor\DbalType\TransactionTypeEnumType', $typesMap['enum.orkestra.transaction_type']);
        $this->assertEquals('Orkestra\Transactor\DbalType\NetworkTypeEnumType',     $typesMap['enum.orkestra.network_type']);
        $this->assertEquals('Orkestra\Transactor\DbalType\AccountTypeEnumType',     $typesMap['enum.orkestra.bank_account_type']);
        $this->assertEquals('Orkestra\Transactor\DbalType\ResultStatusEnumType',    $typesMap['enum.orkestra.result_status']);
        $this->assertEquals('Orkestra\Transactor\DbalType\MonthType',               $typesMap['orkestra.month']);
        $this->assertEquals('Orkestra\Transactor\DbalType\YearType',                $typesMap['orkestra.year']);
    }

    public function testBuild()
    {
        $container = new ContainerBuilder();

        $bundle = new OrkestraTransactorBundle();
        $bundle->build($container);

        $passes = $container->getCompilerPassConfig()->getPasses();
        $passes = array_filter($passes, function(CompilerPassInterface $pass) {
            return $pass instanceof RegisterTransactorsPass;
        });

        $this->assertCount(1, $passes);
    }

    protected function setUp()
    {
        $this->originalTypesMap = \Doctrine\DBAL\Types\Type::getTypesMap();
    }

    protected function tearDown()
    {
        $reflClass = new \ReflectionClass('Doctrine\DBAL\Types\Type');
        $reflProp = $reflClass->getProperty('_typesMap');
        $reflProp->setAccessible(true);
        $reflProp->setValue($this->originalTypesMap);
    }
}
