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

        // manager configuration
        $container->setParameter('rz_tutorial.manager.tutorial.entity',       $config['class']['tutorial']);
        $container->setParameter('rz_tutorial.manager.tutorial_item.entity', $config['class']['tutorial_item']);
        $container->setParameter('rz_tutorial.manager.tutorial_has_item.entity', $config['class']['tutorial_has_item']);
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
    }

    /**
     * @param array $config
     *
     * @return void
     */
    public function registerDoctrineMapping(array $config)
    {
        $collector = DoctrineCollector::getInstance();

        $collector->addAssociation($config['class']['tutorial_item'], 'mapOneToMany', array(
            'fieldName'     => 'tutorialHasItems',
            'targetEntity'  => $config['class']['tutorial_has_item'],
            'cascade'       => array(
                'persist',
            ),
            'mappedBy'      => 'tutorial_item',
            'orphanRemoval' => false,
        ));

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
    }


}
