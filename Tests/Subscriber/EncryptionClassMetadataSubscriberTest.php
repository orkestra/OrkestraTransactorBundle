<?php

/*
 * This file is part of OrkestratTransactorBundle.
 *
 * Copyright (c) Orkestra Community
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Orkestra\Bundle\TransactorBundle\Tests\Subscriber;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Orkestra\Bundle\TransactorBundle\Subscriber\EncryptionClassMetadataSubscriber;

class EncryptionClassMetadataSubscriberTest extends \PHPUnit_Framework_TestCase
{
    public function testSubscriberChangesAccountNumberField()
    {
        $metadata = $this->getMetadata('Orkestra\Transactor\Entity\AbstractAccount');
        $entityManager = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $event = new LoadClassMetadataEventArgs($metadata, $entityManager);

        $subscriber = new EncryptionClassMetadataSubscriber();
        $subscriber->loadClassMetadata($event);

        $this->assertEquals('encrypted_string', $metadata->fieldMappings['accountNumber']['type']);
    }

    public function testSubscriberIgnoresNonAccountEntity()
    {
        $metadata = $this->getMetadata('SomeEntity');
        $entityManager = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $event = new LoadClassMetadataEventArgs($metadata, $entityManager);

        $subscriber = new EncryptionClassMetadataSubscriber();
        $subscriber->loadClassMetadata($event);

        $this->assertEquals('string', $metadata->fieldMappings['accountNumber']['type']);
    }

    /**
     * @param string $className
     *
     * @return \Doctrine\ORM\Mapping\ClassMetadataInfo
     */
    private function getMetadata($className)
    {
        $metadata = new ClassMetadataInfo($className);
        $metadata->fieldMappings['accountNumber']['type'] = 'string';

        return $metadata;
    }
}
