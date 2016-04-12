<?php

namespace Mrapps\EmailBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mrapps_email');

        $rootNode
            ->children()
            ->arrayNode('style')
            ->children()
            ->scalarNode('background_color')->defaultValue('#F5F5F5')->end()
            ->scalarNode('content_color')->defaultValue('#FFFFFF')->end()
            ->scalarNode('bold_color')->defaultValue('#000000')->end()
            ->scalarNode('text_color')->defaultValue('#555555')->end()
            ->scalarNode('main_color')->defaultValue('#AE3742')->end()
            ->scalarNode('main_color_hover')->defaultValue('#882A34')->end()
            ->scalarNode('text_on_main_color')->defaultValue('#FFFFFF')->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
