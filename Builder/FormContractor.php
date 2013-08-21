<?php

namespace Rz\TutorialBundle\Builder;

use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Builder\FormContractorInterface;

use Symfony\Component\Form\FormFactoryInterface;

use Doctrine\ORM\Mapping\ClassMetadataInfo;

use Sonata\DoctrineORMAdminBundle\Admin\FieldDescription;
use Sonata\DoctrineORMAdminBundle\Builder\FormContractor as BaseFormContractor;

class FormContractor extends BaseFormContractor
{
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions($type, FieldDescriptionInterface $fieldDescription)
    {
        $options                             = array();
        $options['sonata_field_description'] = $fieldDescription;

        if ($type == 'sonata_type_model' || $type == 'sonata_type_model_list') {

            if ($fieldDescription->getOption('edit') == 'list') {
                throw new \LogicException('The ``sonata_type_model`` type does not accept an ``edit`` option anymore, please review the UPGRADE-2.1.md file from the SonataAdminBundle');
            }

            $options['class']         = $fieldDescription->getTargetEntity();
            $options['model_manager'] = $fieldDescription->getAdmin()->getModelManager();

        } elseif ($type == 'sonata_type_admin') {

            if (!$fieldDescription->getAssociationAdmin()) {
                throw new \RuntimeException(sprintf('The current field `%s` is not linked to an admin. Please create one for the target entity : `%s`', $fieldDescription->getName(), $fieldDescription->getTargetEntity()));
            }

            $options['data_class'] = $fieldDescription->getAssociationAdmin()->getClass();
            $fieldDescription->setOption('edit', $fieldDescription->getOption('edit', 'admin'));

        } elseif ($type == 'sonata_type_collection' || $type == 'rz_tutorial_image_maps_type_collection') {

            if (!$fieldDescription->getAssociationAdmin()) {
                throw new \RuntimeException(sprintf('The current field `%s` is not linked to an admin. Please create one for the target entity : `%s`', $fieldDescription->getName(), $fieldDescription->getTargetEntity()));
            }

            $options['type']         = 'sonata_type_admin';
            $options['modifiable']   = true;
            $options['type_options'] = array(
                'sonata_field_description' => $fieldDescription,
                'data_class'               => $fieldDescription->getAssociationAdmin()->getClass()
            );

        }

        return $options;
    }
}
