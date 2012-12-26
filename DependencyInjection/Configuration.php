<?php

namespace Orkestra\Bundle\TransactorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('orkestra_transactor');

        $rootNode
            ->children()
                ->booleanNode('enable_encryption')->defaultFalse()->end()
            ->end();

        return $treeBuilder;
    }
}
