<?php

namespace Rz\TutorialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;
use Knp\Menu\ItemInterface as MenuItemInterface;


class TrainingUserProgressAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
        ->add('user')
        ->add('training')
        ->add('accomplished')
        ->add('total')
        ->add('current')
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
        ->add('user.username', null, array('footable'=>array('attr'=>array('data_toggle'=>true))))
        ->add('training.title', null, array('footable'=>array('attr'=>array('data_hide'=>'phone'))))
        ->add('total', null, array('footable'=>array('attr'=>array('data_hide'=>'phone'))))
        ->add('current', null, array('footable'=>array('attr'=>array('data_hide'=>'phone'))))
        ->add('accomplished', null)
        ->add('_action', 'action',  array(
                           'actions' => array(
                               'view' => array('template' => 'RzTutorialBundle:TrainingUserProgressAdmin:list_action_show.html.twig',
                                               'footable'=>array('attr'=>array('data_hide'=>'phone,tablet'))),
                           ))
            );
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('user.username')
        ->add('training')
        ->add('accomplished');
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        // fix weird bug with setter object not being call
        $object->setTutorialUserProgress($object->getTutorialUserProgress());
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        // fix weird bug with setter object not being call
        $object->setTutorialUserProgress($object->getTutorialUserProgress());
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list', 'show', 'export'));
    }

    /**
     * {@inheritdoc}
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;


        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            $this->trans('sidemenu.link_list_tutorial_user_progress'),
            array('uri' => $admin->generateUrl('rz_tutorial.admin.tutorial_user_progress.list', array('id' => $id)))
        );
    }
}
