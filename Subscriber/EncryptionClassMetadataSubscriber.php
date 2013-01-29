<?php

/*
 * This file is part of OrkestraTransactorBundle.
 *
 * Copyright (c) Orkestra Community
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Orkestra\Bundle\TransactorBundle\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

/**
 * Responsible for changing an AbstractAccount's 'accountNumber' field
 * into an encrypted string type, effectively adding encryption of the field.
 */
class EncryptionClassMetadataSubscriber implements EventSubscriber
{
    /**
     * @param \Doctrine\ORM\Event\LoadClassMetadataEventArgs $event
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $event)
    {
        $metadata = $event->getClassMetadata();

        if ('Orkestra\Transactor\Entity\AbstractAccount' === $metadata->name) {
            $metadata->fieldMappings['accountNumber']['type'] = 'encrypted_string';
        } elseif ('Orkestra\Transactor\Entity\Account\SwipedCardAccount' === $metadata->name) {
            $metadata->fieldMappings['trackOne']['type']
                = $metadata->fieldMappings['trackTwo']['type']
                = $metadata->fieldMappings['trackThree']['type']
                = 'encrypted_string';
        }
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(Events::loadClassMetadata);
    }
}
