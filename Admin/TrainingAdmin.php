<?php

namespace Rz\TutorialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AdminInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;

class TrainingAdmin extends Admin
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
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('title', null, array('footable'=>array('attr'=>array('data_toggle'=>true))))
        ->add('isPublished', null, array('editable' => true, 'footable'=>array('attr'=>array('data_hide'=>'phone'))))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
        ->with('Details')
            ->add('title', null, array('required' => true))
            ->add('description', 'rz_ckeditor', array('required' => false))
        ->end()
        ->with('Content')
            ->add('content', 'rz_ckeditor', array('required' => false))
        ->end()
        ->with('Tutorials')
            ->add('trainingHasTutorials', 'sonata_type_collection', array(
                                        'cascade_validation' => true,
                                        //'attr' => array('class'=>'span6'),
                                    ), array(
                      'edit' => 'inline',
                      'inline' => 'table',
                      //'inline' => 'standard',
                      'sortable'  => 'position',
                      'admin_code' => 'rz_tutorial.admin.training_has_tutorial'
                  )
                )
        ->end()
        ->with('Users')
            ->add('userHasTrainings', 'sonata_type_collection', array(
                                            'cascade_validation' => true,
                                            //'attr' => array('class'=>'span6'),
                                        ), array(
                      'edit' => 'inline',
                      'inline' => 'table',
                      //'inline' => 'standard',
                      'sortable'  => 'position',
                      'admin_code' => 'rz_tutorial.admin.user_has_training'
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
    public function prePersist($training)
    {
        // fix weird bug with setter object not being call
        $training->setTrainingHasTutorials($training->getTrainingHasTutorials());
        $training->setUserHasTrainings($training->getUserHasTrainings());
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($training)
    {
        // fix weird bug with setter object not being call
        $training->setTrainingHasTutorials($training->getTrainingHasTutorials());
        $training->setUserHasTrainings($training->getUserHasTrainings());
    }
}
