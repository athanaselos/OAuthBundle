<?php

namespace APinnecke\Bundle\OAuthBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    private $alias;

    /**
     * @param $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root($this->alias);

        $rootNode->children()
            ->arrayNode('resource_owners')
                ->isRequired()
                ->useAttributeAsKey('name')
                ->prototype('array')
                    ->children()
                        ->scalarNode('client_id')->cannotBeEmpty()->end()
                        ->scalarNode('client_secret')->cannotBeEmpty()->end()
                        ->scalarNode('client_secret')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
