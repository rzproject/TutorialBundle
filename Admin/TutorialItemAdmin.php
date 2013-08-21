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
        ->add('description')
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
                ->add('description', null, array('required' => true))
            ->end()
            ->with('Text Content')
                ->add('content', null, array('required' => false))
            ->end()
            ->with('Image')
                ->add('coordinates', 'hidden', array('required' => false, 'mapped'=>false))
                ->add('media', 'rz_type_tutorial_screenshot',
                             array('required' => true,
                                   'link_coordinates'=> $coordinates ?: null,
//                                   'x1'=> $coordinates ? $coordinates['x1']: null,
//                                   'y1'=> $coordinates ? $coordinates['y1']: null,
//                                   'x2'=> $coordinates ? $coordinates['x2']: null,
//                                   'y2'=> $coordinates ? $coordinates['y2']: null,
                                     //'reference_field' => 'tutorialImageMaps',
                                  ),
                             array('link_parameters' => array('context'=>'default', 'provider'=>'sonata.media.provider.image'))
                     )
//                ->add('tutorialImageMaps', 'rz_tutorial_image_maps_type_collection', array(
//                                             'cascade_validation' => true,
//                                             //'attr' => array('class'=>'span6'),
//                                         ), array(
//                          'edit' => 'inline',
//                          //'inline' => 'table',
//                          //'inline' => 'standard',
//                          'sortable'  => 'position',
//                          'admin_code' => 'rz_tutorial.admin.tutorial_image_maps'
//                      )
//                    )
//                ->add('x1', 'hidden', array('required' => false, 'mapped'=>false, 'data'=> $coordinates ? $coordinates['x1']: null))
//                ->add('y1', 'hidden', array('required' => false, 'mapped'=>false, 'data'=> $coordinates ? $coordinates['y1']: null))
//                ->add('x2', 'hidden', array('required' => false, 'mapped'=>false, 'data'=> $coordinates ? $coordinates['x2']: null))
//                ->add('y2', 'hidden', array('required' => false, 'mapped'=>false, 'data'=> $coordinates ? $coordinates['y2']: null))
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
