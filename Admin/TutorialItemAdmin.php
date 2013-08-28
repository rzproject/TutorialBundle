<?php

namespace Rz\TutorialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TutorialItemAdmin extends Admin
{

    protected $parentAssociationMapping = 'tutorial';

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
        ->add('title')
        ->add('description')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('title', null, array('footable'=>array('attr'=>array('data_toggle'=>true))))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {

        $coordinates = $this->getSubject()->getLinkCoordinates() ?: null;

        $fieldDescription = $this->getModelManager()->getNewFieldDescriptionInstance($this->getClass(), 'tutorialImageMaps' );

        $formMapper
            ->with('Details')
                ->add('title', null, array('required' => true))
                ->add('description', 'rz_ckeditor', array('required' => false))
            ->end()
            ->with('Text Content')
                ->add('content', 'rz_ckeditor', array('required' => false))
            ->end()
            ->with('Image')
                ->add('coordinates', 'hidden', array('required' => false, 'mapped'=>false))
                ->add('media', 'rz_type_tutorial_screenshot',
                             array('required' => true,
                                   'link_coordinates'=> $coordinates ?: null,
                                   'attr'=>array('class'=>'span12')
                                  ),
                             array('link_parameters' => array('context'=>'tutorial', 'provider'=>'sonata.media.provider.image'))
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
}
