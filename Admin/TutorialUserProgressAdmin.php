<?php

namespace Rz\TutorialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class TutorialUserProgressAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
        ->add('trainingUserProgress.training.title')
        ->add('trainingUserProgress.user.username')
        ->add('tutorial')
        ->add('accomplished')
        ->add('started')
        ->add('ended')
        ->add('elapseTime')
        ->add('createdAt')
        ->add('updatedAt')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->add('trainingUserProgress.training.title', null, array('footable'=>array('attr'=>array('data_toggle'=>true))))
        ->add('trainingUserProgress.user.username', null, array('footable'=>array('attr'=>array('data_toggle'=>true))))
        ->add('tutorial.title', null, array('footable'=>array('attr'=>array('data_toggle'=>true))))
        ->add('accomplished', null)
        ->add('_action', 'action',  array(
                'actions' => array(
                    'view' => array('template' => 'RzTutorialBundle:TutorialUserProgressAdmin:list_action_show.html.twig',
                                    'footable'=>array('attr'=>array('data_hide'=>'phone,tablet'))),
                ))
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('trainingUserProgress.user.username')
            ->add('tutorial.title')
            ->add('elapseTime')
            ->add('accomplished');
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list', 'show', 'export'));
    }
}
