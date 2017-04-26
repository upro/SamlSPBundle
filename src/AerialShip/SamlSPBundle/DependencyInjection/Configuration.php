<?php

namespace AerialShip\SamlSPBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root = $treeBuilder->root('aerial_ship_saml_sp');

        $root->children()
            ->enumNode('driver')
                ->values(array('orm', 'mongodb'))
                ->validate()
                ->ifTrue(function ($v) {return '' === $v;})
                ->thenInvalid('Cannot be the empty string')
                ->end()
                ->defaultValue('orm')
                ->end()
            ->scalarNode('sso_state_entity_class')
                ->isRequired()
                ->validate()
                ->ifTrue(function ($v) {return '' === $v;})
                ->thenInvalid('Cannot be the empty string')
                ->end()
            ->end()
            ->scalarNode('model_manager_name')
                ->defaultNull()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
