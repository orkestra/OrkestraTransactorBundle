<?php

/*
 * This file is part of OrkestraTransactorBundle.
 *
 * Copyright (c) Orkestra Community
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Orkestra\Bundle\TransactorBundle\Tests\DependencyInjection;

use Orkestra\Bundle\TransactorBundle\DependencyInjection\OrkestraTransactorExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Yaml;

class OrkestraTransactorExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultConfiguration()
    {
        $container = new ContainerBuilder();
        $extension = new OrkestraTransactorExtension();
        $extension->load(array(), $container);

        $this->assertFalse($container->hasDefinition('orkestra.transactor.encryption_metadata_subscriber'));
    }

    public function testDisableEncryptionConfiguration()
    {
        $yaml = <<<END
enable_encryption: false
END;

        $config = Yaml::parse($yaml);
        $container = new ContainerBuilder();
        $extension = new OrkestraTransactorExtension();
        $extension->load(array($config), $container);

        $this->assertFalse($container->hasDefinition('orkestra.transactor.encryption_metadata_subscriber'));
    }

    public function testEnableEncryptionConfiguration()
    {
        $yaml = <<<END
enable_encryption: true
END;

        $config = Yaml::parse($yaml);
        $container = new ContainerBuilder();
        $extension = new OrkestraTransactorExtension();
        $extension->load(array($config), $container);

        $this->assertTrue($container->hasDefinition('orkestra.transactor.encryption_metadata_subscriber'));
    }
    
    public function testCertificateAuthority()
    {
        $yaml = <<<END
certificate_authority: true
END;

        $config = Yaml::parse($yaml);
        $container = new ContainerBuilder();
        $extension = new OrkestraTransactorExtension();
        $extension->load(array($config), $container);
        
        $this->assertTrue($container->getParameter('orkestra.ca_bundle.path'));
    }
    
    public function testCertificateAuthorityDefaultValue()
    {
        $config = Yaml::parse('');
        $container = new ContainerBuilder();
        $extension = new OrkestraTransactorExtension();
        $extension->load(array($config), $container);
        
        $this->assertFalse($container->getParameter('orkestra.ca_bundle.path'));
    }
}
