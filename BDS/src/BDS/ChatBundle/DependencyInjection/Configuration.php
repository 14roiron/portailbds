<?php

namespace BDS\ChatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('bds_chat');

        $rootNode->children()
		->scalarNode('update_interval')->defaultValue(5000)->end()
		->scalarNode('number_of_messages')->defaultValue(10)->end()
		->end();

        return $treeBuilder;
    }
    
}

