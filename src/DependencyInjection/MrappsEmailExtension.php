<?php

namespace Mrapps\EmailBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class MrappsEmailExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('mrapps_email.style.background_color', $config['style']['background_color']);
        $container->setParameter('mrapps_email.style.content_color', $config['style']['content_color']);
        $container->setParameter('mrapps_email.style.bold_color', $config['style']['bold_color']);
        $container->setParameter('mrapps_email.style.text_color', $config['style']['text_color']);
        $container->setParameter('mrapps_email.style.main_color', $config['style']['main_color']);
        $container->setParameter('mrapps_email.style.main_color_hover', $config['style']['main_color_hover']);
        $container->setParameter('mrapps_email.style.text_on_main_color', $config['style']['text_on_main_color']);


        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}
