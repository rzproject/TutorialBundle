<?php

namespace Rz\TutorialBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Config\Definition\Processor;
use Sonata\EasyExtendsBundle\Mapper\DoctrineCollector;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RzTutorialExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('admin.xml');
        $loader->load('services.xml');
        $loader->load('form.xml');
        $loader->load('doctrine_orm.xml');
        $loader->load('block.xml');
        $this->registerDoctrineMapping($config);
        $this->configureClass($config, $container);
        $this->configureAdmin($config, $container);
        $this->configureRzTemplates($config, $container);

        // merge RzFieldTypeBundle to RzAdminBundle
        $container->setParameter('twig.form.resources',
                                 array_merge(
                                     $container->getParameter('twig.form.resources'),
                                     array('RzTutorialBundle:Form:form_type.html.twig')
                                 ));
    }


    /**
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function configureClass($config, ContainerBuilder $container)
    {
        // admin configuration
        $container->setParameter('rz_tutorial.admin.tutorial.entity',       $config['class']['tutorial']);
        $container->setParameter('rz_tutorial.admin.tutorial_item.entity', $config['class']['tutorial_item']);
        $container->setParameter('rz_tutorial.admin.tutorial_has_item.entity', $config['class']['tutorial_has_item']);
        $container->setParameter('rz_tutorial.admin.training.entity', $config['class']['training']);
        $container->setParameter('rz_tutorial.admin.training_has_tutorial.entity', $config['class']['training_has_tutorial']);
        $container->setParameter('rz_tutorial.admin.user_has_training.entity', $config['class']['user_has_training']);
        $container->setParameter('rz_tutorial.admin.training_user_progress.entity', $config['class']['training_user_progress']);
        $container->setParameter('rz_tutorial.admin.tutorial_user_progress.entity', $config['class']['tutorial_user_progress']);

        // manager configuration
        $container->setParameter('rz_tutorial.manager.tutorial.entity',       $config['class']['tutorial']);
        $container->setParameter('rz_tutorial.manager.tutorial_item.entity', $config['class']['tutorial_item']);
        $container->setParameter('rz_tutorial.manager.tutorial_has_item.entity', $config['class']['tutorial_has_item']);
        $container->setParameter('rz_tutorial.manager.training.entity', $config['class']['training']);
        $container->setParameter('rz_tutorial.manager.training_has_tutorial.entity', $config['class']['training_has_tutorial']);
        $container->setParameter('rz_tutorial.manager.user_has_training.entity', $config['class']['user_has_training']);
        $container->setParameter('rz_tutorial.manager.training_user_progress.entity', $config['class']['training_user_progress']);
        $container->setParameter('rz_tutorial.manager.tutorial_user_progress.entity', $config['class']['tutorial_user_progress']);
    }

    /**
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function configureAdmin($config, ContainerBuilder $container)
    {
        $container->setParameter('rz_tutorial.admin.tutorial.class',              $config['admin']['tutorial']['class']);
        $container->setParameter('rz_tutorial.admin.tutorial.controller',         $config['admin']['tutorial']['controller']);
        $container->setParameter('rz_tutorial.admin.tutorial.translation_domain', $config['admin']['tutorial']['translation']);

        $container->setParameter('rz_tutorial.admin.tutorial_item.class',              $config['admin']['tutorial_item']['class']);
        $container->setParameter('rz_tutorial.admin.tutorial_item.controller',         $config['admin']['tutorial_item']['controller']);
        $container->setParameter('rz_tutorial.admin.tutorial_item.translation_domain', $config['admin']['tutorial_item']['translation']);

        $container->setParameter('rz_tutorial.admin.tutorial_has_item.class',              $config['admin']['tutorial_has_item']['class']);
        $container->setParameter('rz_tutorial.admin.tutorial_has_item.controller',         $config['admin']['tutorial_has_item']['controller']);
        $container->setParameter('rz_tutorial.admin.tutorial_has_item.translation_domain', $config['admin']['tutorial_has_item']['translation']);

        $container->setParameter('rz_tutorial.admin.training.class',              $config['admin']['training']['class']);
        $container->setParameter('rz_tutorial.admin.training.controller',         $config['admin']['training']['controller']);
        $container->setParameter('rz_tutorial.admin.training.translation_domain', $config['admin']['training']['translation']);

        $container->setParameter('rz_tutorial.admin.training_has_tutorial.class',              $config['admin']['training_has_tutorial']['class']);
        $container->setParameter('rz_tutorial.admin.training_has_tutorial.controller',         $config['admin']['training_has_tutorial']['controller']);
        $container->setParameter('rz_tutorial.admin.training_has_tutorial.translation_domain', $config['admin']['training_has_tutorial']['translation']);

        $container->setParameter('rz_tutorial.admin.user_has_training.class',              $config['admin']['user_has_training']['class']);
        $container->setParameter('rz_tutorial.admin.user_has_training.controller',         $config['admin']['user_has_training']['controller']);
        $container->setParameter('rz_tutorial.admin.user_has_training.translation_domain', $config['admin']['user_has_training']['translation']);

        $container->setParameter('rz_tutorial.admin.training_user_progress.class',              $config['admin']['training_user_progress']['class']);
        $container->setParameter('rz_tutorial.admin.training_user_progress.controller',         $config['admin']['training_user_progress']['controller']);
        $container->setParameter('rz_tutorial.admin.training_user_progress.translation_domain', $config['admin']['training_user_progress']['translation']);

        $container->setParameter('rz_tutorial.admin.tutorial_user_progress.class',              $config['admin']['tutorial_user_progress']['class']);
        $container->setParameter('rz_tutorial.admin.tutorial_user_progress.controller',         $config['admin']['tutorial_user_progress']['controller']);
        $container->setParameter('rz_tutorial.admin.tutorial_user_progress.translation_domain', $config['admin']['tutorial_user_progress']['translation']);
    }

    /**
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @return void
     */
    public function configureRzTemplates($config, ContainerBuilder $container)
    {
        $container->setParameter('rz_tutorial.configuration.tutorial.templates', $config['admin']['tutorial']['templates']);
        $container->setParameter('rz_tutorial.configuration.tutorial_item.templates', $config['admin']['tutorial_item']['templates']);
        $container->setParameter('rz_tutorial.configuration.tutorial_has_item.templates', $config['admin']['tutorial_has_item']['templates']);
        $container->setParameter('rz_tutorial.configuration.training.templates', $config['admin']['training']['templates']);
        $container->setParameter('rz_tutorial.configuration.training_has_tutorial.templates', $config['admin']['training_has_tutorial']['templates']);
        $container->setParameter('rz_tutorial.configuration.user_has_training.templates', $config['admin']['user_has_training']['templates']);
        $container->setParameter('rz_tutorial.configuration.training_user_progress.templates', $config['admin']['training_user_progress']['templates']);
        $container->setParameter('rz_tutorial.configuration.tutorial_user_progress.templates', $config['admin']['tutorial_user_progress']['templates']);
    }

    /**
     * @param array $config
     *
     * @return void
     */
    public function registerDoctrineMapping(array $config)
    {
        $collector = DoctrineCollector::getInstance();

        $collector->addAssociation($config['class']['tutorial_item'], 'mapManyToOne', array(
            'fieldName'     => 'media',
            'targetEntity'  => $config['class']['media'],
            'cascade'       => array(
                1 => 'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => NULL,
            'joinColumns'   =>  array(
                array(
                    'name'  => 'media_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
            'default' => null,
        ));

        $collector->addAssociation($config['class']['tutorial_item'], 'mapOneToMany', array(
            'fieldName'     => 'tutorialHasItems',
            'targetEntity'  => $config['class']['tutorial_has_item'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'tutorial_item',
            'orphanRemoval' => false,
        ));


        $collector->addAssociation($config['class']['tutorial_has_item'], 'mapManyToOne', array(
            'fieldName'     => 'tutorial',
            'targetEntity'  => $config['class']['tutorial'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'tutorialHasItems',
            'joinColumns'   =>  array(
                array(
                    'name'  => 'tutorial_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));

        $collector->addAssociation($config['class']['tutorial_has_item'], 'mapManyToOne', array(
            'fieldName'     => 'tutorialItem',
            'targetEntity'  => $config['class']['tutorial_item'],
            'cascade'       => array(
                 'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'tutorialHasItems',
            'joinColumns'   => array(
                array(
                    'name'  => 'tutorial_item_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));

        $collector->addAssociation($config['class']['tutorial'], 'mapOneToMany', array(
            'fieldName'     => 'tutorialHasItems',
            'targetEntity'  => $config['class']['tutorial_has_item'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'tutorial',
            'orphanRemoval' => true,
            'orderBy'       => array(
                'position'  => 'ASC',
            ),
        ));

        $collector->addAssociation($config['class']['training_has_tutorial'], 'mapManyToOne', array(
            'fieldName'     => 'tutorial',
            'targetEntity'  => $config['class']['tutorial'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'trainingHasTutorial',
            'joinColumns'   =>  array(
                array(
                    'name'  => 'tutorial_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));


        $collector->addAssociation($config['class']['training_has_tutorial'], 'mapManyToOne', array(
            'fieldName'     => 'training',
            'targetEntity'  => $config['class']['training'],
            'cascade'       => array(
                 'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'trainingHasTutorial',
            'joinColumns'   => array(
                array(
                    'name'  => 'training_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));

        $collector->addAssociation($config['class']['training'], 'mapOneToMany', array(
            'fieldName'     => 'trainingHasTutorials',
            'targetEntity'  => $config['class']['training_has_tutorial'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'training',
            'orphanRemoval' => true,
            'orderBy'       => array(
                'position'  => 'ASC',
            ),
        ));

        $collector->addAssociation($config['class']['training'], 'mapOneToMany', array(
            'fieldName'     => 'userHasTrainings',
            'targetEntity'  => $config['class']['user_has_training'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'training',
            'orphanRemoval' => true,
            'orderBy'       => array(
                'position'  => 'ASC',
            ),
        ));

        $collector->addAssociation($config['class']['training'], 'mapOneToMany', array(
            'fieldName'     => 'trainingUserProgress',
            'targetEntity'  => $config['class']['training_user_progress'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'training',
            'orphanRemoval' => true,
            'orderBy'       => array(
                'position'  => 'ASC',
            ),
        ));

        $collector->addAssociation($config['class']['tutorial'], 'mapOneToMany', array(
            'fieldName'     => 'trainingHasTutorials',
            'targetEntity'  => $config['class']['training_has_tutorial'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'tutorial',
            'orphanRemoval' => true,
            'orderBy'       => array(
                'position'  => 'ASC',
            ),
        ));


        $collector->addAssociation($config['class']['tutorial'], 'mapOneToMany', array(
            'fieldName'     => 'tutorialUserProgress',
            'targetEntity'  => $config['class']['tutorial_user_progress'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'tutorial',
            'orphanRemoval' => true,
            'orderBy'       => array(
                'position'  => 'ASC',
            ),
        ));

        $collector->addAssociation($config['class']['user_has_training'], 'mapManyToOne', array(
            'fieldName'     => 'training',
            'targetEntity'  => $config['class']['training'],
            'cascade'       => array(
                 'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'userHasTraining',
            'joinColumns'   => array(
                array(
                    'name'  => 'training_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));

        $collector->addAssociation($config['class']['user_has_training'], 'mapManyToOne', array(
            'fieldName'     => 'user',
            'targetEntity'  => $config['class']['user'],
            'cascade'       => array(
                 'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'userHasTraining',
            'joinColumns'   => array(
                array(
                    'name'  => 'user_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));


        $collector->addAssociation($config['class']['training_user_progress'], 'mapManyToOne', array(
            'fieldName'     => 'training',
            'targetEntity'  => $config['class']['training'],
            'cascade'       => array(
                 'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'trainingUserProgress',
            'joinColumns'   => array(
                array(
                    'name'  => 'training_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));

        $collector->addAssociation($config['class']['training_user_progress'], 'mapManyToOne', array(
            'fieldName'     => 'user',
            'targetEntity'  => $config['class']['user'],
            'cascade'       => array(
                 'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'trainingUserProgress',
            'joinColumns'   => array(
                array(
                    'name'  => 'user_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));


        $collector->addAssociation($config['class']['training_user_progress'], 'mapOneToMany', array(
            'fieldName'     => 'tutorialUserProgress',
            'targetEntity'  => $config['class']['tutorial_user_progress'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'trainingUserProgress',
            'orphanRemoval' => true,
            'orderBy'       => array(
                'position'  => 'ASC',
            ),
        ));

        $collector->addAssociation($config['class']['tutorial_user_progress'], 'mapManyToOne', array(
            'fieldName'     => 'tutorial',
            'targetEntity'  => $config['class']['tutorial'],
            'cascade'       => array(
                 'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'tutorialUserProgress',
            'joinColumns'   => array(
                array(
                    'name'  => 'tutorial_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));

        $collector->addAssociation($config['class']['tutorial_user_progress'], 'mapManyToOne', array(
            'fieldName'     => 'trainingUserProgress',
            'targetEntity'  => $config['class']['training_user_progress'],
            'cascade'       => array(
                 'persist',
            ),
            'mappedBy'      => NULL,
            'inversedBy'    => 'tutorialUserProgress',
            'joinColumns'   => array(
                array(
                    'name'  => 'training_user_progress_id',
                    'referencedColumnName' => 'id',
                ),
            ),
            'orphanRemoval' => false,
        ));
    }
}
