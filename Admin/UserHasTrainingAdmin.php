<?php

namespace Rz\TutorialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class UserHasTrainingAdmin extends Admin
{
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
        ->add('user', 'sonata_type_model_list', array('required' => false, 'attr'=>array('class'=>'span12')))
        ->add('isActive', null, array('required' => false))
        ->add('position', 'hidden')
        ;
    }

    /**
     * @param  \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->add('user')
        ->add('training')
        ->add('position')
        ->add('isActive')
        ;
    }
}
