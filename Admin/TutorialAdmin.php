<?php

namespace Rz\TutorialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class TutorialAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('description')
            ->add('content')
            ->add('tutorialHasItems')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('title', null, array('footable'=>array('attr'=>array('data_toggle'=>true))))
        ->add('description')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Tutorial')
                ->add('title', null, array('required' => true))
                ->add('description', null, array('required' => true))
                ->add('content', null, array('required' => true))
            ->end()
            ->with('Steps')
            ->add('tutorialHasItems', 'sonata_type_collection', array(
                                        'cascade_validation' => true,
                                        //'attr' => array('class'=>'span6'),
                                    ), array(
                      'edit' => 'inline',
                      'inline' => 'table',
                      //'inline' => 'standard',
                      'sortable'  => 'position',
                      'admin_code' => 'rz_tutorial.admin.tutorial_has_item'
                  )
                )
            ->end()

        ;


    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('description');
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($tutorial)
    {
        // fix weird bug with setter object not being call
        $tutorial->setTutorialHasItems($tutorial->getTutorialHasItems());
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($tutorial)
    {
        // fix weird bug with setter object not being call
        $tutorial->setTutorialHasItems($tutorial->getTutorialHasItems());
    }
}
