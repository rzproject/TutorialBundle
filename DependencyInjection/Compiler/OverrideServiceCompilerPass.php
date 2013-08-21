<?php

namespace Rz\TutorialBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('rz_tutorial.admin.tutorial_item');
        $definedTemplates = array_merge($container->getParameter('sonata.admin.configuration.templates'),
                                        $container->getParameter('rz_tutorial.configuration.tutorial_item.templates'));
        $definition->addMethodCall('setTemplates', array($definedTemplates));

        $definition = $container->getDefinition('rz_tutorial.admin.tutorial');
        $definedTemplates = array_merge($container->getParameter('sonata.admin.configuration.templates'),
                                        $container->getParameter('rz_tutorial.configuration.tutorial.templates'));
        $definition->addMethodCall('setTemplates', array($definedTemplates));
    }
}
