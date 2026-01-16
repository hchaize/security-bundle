<?php

/*
 * (c) Yannis Sgarra <hello@yannissgarra.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Webmunkeez\SecurityBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Yannis Sgarra <hello@yannissgarra.com>
 */
final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('webmunkeez_security');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('user_provider')
                    ->isRequired()
                    ->children()
                        ->arrayNode('public')
                            ->isRequired()
                            ->children()
                                ->scalarNode('id')
                                    ->isRequired()
                                    ->cannotBeEmpty()
                                ->end() // id
                            ->end()
                        ->end() // public
                        ->arrayNode('private')
                            ->isRequired()
                            ->children()
                                ->scalarNode('id')
                                    ->isRequired()
                                    ->cannotBeEmpty()
                                ->end() // id
                            ->end()
                        ->end() // private
                    ->end()
                ->end() // user_provider
                ->arrayNode('cookie')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('name')
                            ->cannotBeEmpty()
                            ->defaultValue('SESSION_TOKEN')
                        ->end() // name
                    ->end()
                ->end() // cookie
                ->arrayNode('jwt')
                    ->addDefaultsIfNotSet()
                    ->isRequired()
                    ->children()
                        ->scalarNode('public_key_path')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end() // public_key
                        ->scalarNode('secret_key_path')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end() // secret_key
                        ->scalarNode('pass_phrase')->end()
                        ->scalarNode('token_ttl')
                            ->defaultValue('1 year')
                        ->end() // token_ttl
                    ->end()
                ->end() // jwt
            ->end();

        return $treeBuilder;
    }
}
