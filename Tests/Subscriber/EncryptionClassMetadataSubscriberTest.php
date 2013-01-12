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
