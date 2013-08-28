<?php

namespace Rz\TutorialBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('rz_tutorial');
        $this->addBundleSettings($node);
        $this->addModelSettings($node);
        return $treeBuilder;
    }

      /**
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    private function addBundleSettings(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('admin')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('tutorial')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->cannotBeEmpty()->defaultValue('Rz\\TutorialBundle\\Admin\\TutorialAdmin')->end()
                                ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                                ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzTutorialBundle-Tutorial')->end()
                                ->arrayNode('templates')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('edit')->defaultValue('RzTutorialBundle:CRUD:edit.html.twig')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('tutorial_item')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->cannotBeEmpty()->defaultValue('Rz\\TutorialBundle\\Admin\\TutorialItemAdmin')->end()
                                ->scalarNode('controller')->cannotBeEmpty()->defaultValue('RzTutorialBundle:TutorialItemAdmin')->end()
                                ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzTutorialBundle-TutorialItem')->end()
                                ->arrayNode('templates')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('edit')->defaultValue('RzTutorialBundle:CRUD:edit.html.twig')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('tutorial_has_item')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->cannotBeEmpty()->defaultValue('Rz\\TutorialBundle\\Admin\\TutorialHasItemAdmin')->end()
                                ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                                ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzTutorialBundle-TutorialHasItem')->end()
                                ->arrayNode('templates')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('list')->defaultValue('SonataAdminBundle:CRUD:list.html.twig')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('training')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->cannotBeEmpty()->defaultValue('Rz\\TutorialBundle\\Admin\\TrainingAdmin')->end()
                                ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                                ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzTutorialBundle-Training')->end()
                                ->arrayNode('templates')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('edit')->defaultValue('RzTutorialBundle:CRUD:edit.html.twig')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('training_has_tutorial')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->cannotBeEmpty()->defaultValue('Rz\\TutorialBundle\\Admin\\TrainingHasTutorialAdmin')->end()
                                ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                                ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzTutorialBundle-TrainingHasTutorial')->end()
                                ->arrayNode('templates')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('list')->defaultValue('SonataAdminBundle:CRUD:list.html.twig')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('user_has_training')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->cannotBeEmpty()->defaultValue('Rz\\TutorialBundle\\Admin\\UserHasTrainingAdmin')->end()
                                ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                                ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzTutorialBundle-UserHasTraining')->end()
                                ->arrayNode('templates')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('list')->defaultValue('SonataAdminBundle:CRUD:list.html.twig')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('training_user_progress')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->cannotBeEmpty()->defaultValue('Rz\\TutorialBundle\\Admin\\TrainingUserProgressAdmin')->end()
                                ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                                ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzTutorialBundle-TrainingUserProgress')->end()
                                ->arrayNode('templates')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('list')->defaultValue('SonataAdminBundle:CRUD:list.html.twig')->cannotBeEmpty()->end()
                                        //->scalarNode('base_list_field')->defaultValue('RzTutorialBundle:TrainingUserProgressAdmin:list_field.html.twig')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('tutorial_user_progress')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->cannotBeEmpty()->defaultValue('Rz\\TutorialBundle\\Admin\\TutorialUserProgressAdmin')->end()
                                ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                                ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzTutorialBundle-TutorialUserProgress')->end()
                                ->arrayNode('templates')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('list')->defaultValue('SonataAdminBundle:CRUD:list.html.twig')->cannotBeEmpty()->end()
//                                        ->scalarNode('base_list_field')->defaultValue('RzTutorialBundle:TutorialUserProgressAdmin:list_field.html.twig')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

        /**
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    private function addModelSettings(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('tutorial')->defaultValue('Application\\Rz\\TutorialBundle\\Entity\\Tutorial')->end()
                        ->scalarNode('tutorial_item')->defaultValue('Application\\Rz\\TutorialBundle\\Entity\\TutorialItem')->end()
                        ->scalarNode('tutorial_has_item')->defaultValue('Application\\Rz\\TutorialBundle\\Entity\\TutorialHasItem')->end()
                        ->scalarNode('media')->defaultValue('Application\\Sonata\\MediaBundle\\Entity\\Media')->end()
                        ->scalarNode('user')->defaultValue('Application\\Sonata\\UserBundle\\Entity\\User')->end()
                        ->scalarNode('training')->defaultValue('Application\\Rz\\TutorialBundle\\Entity\\Training')->end()
                        ->scalarNode('training_has_tutorial')->defaultValue('Application\\Rz\\TutorialBundle\\Entity\\TrainingHasTutorial')->end()
                        ->scalarNode('user_has_training')->defaultValue('Application\\Rz\\TutorialBundle\\Entity\\UserHasTraining')->end()
                        ->scalarNode('training_user_progress')->defaultValue('Application\\Rz\\TutorialBundle\\Entity\\TrainingUserProgress')->end()
                        ->scalarNode('tutorial_user_progress')->defaultValue('Application\\Rz\\TutorialBundle\\Entity\\TutorialUserProgress')->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
