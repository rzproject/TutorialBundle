<?php

namespace Rz\TutorialBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;

class TutorialScreenshotType extends AbstractType
{
    protected $modelManager;
    protected $class;

    public function __construct($modelManager, $class) {
        $this->modelManager = $modelManager;
        $this->class = $class;
    }


    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->resetViewTransformers()
        ->addViewTransformer(new ModelToIdTransformer($options['model_manager'], $options['class']));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (isset($view->vars['sonata_admin'])) {
            // set the correct edit mode
            $view->vars['sonata_admin']['edit'] = 'list';
        }
        //set jcrop default values if any
          $view->vars['link_coordinates'] =  $options['link_coordinates'] ?: null;
          $view->vars['link_coordinates_count'] =  $options['link_coordinates'] ? count($options['link_coordinates']): 0;
//        $view->vars['link_coordinates']['x1'] =  $options['x1'] ?: null;
//        $view->vars['link_coordinates']['y1'] =  $options['y1'] ?: null;
//        $view->vars['link_coordinates']['x2'] =  $options['x2'] ?: null;
//        $view->vars['link_coordinates']['y2'] =  $options['y2'] ?: null;
//        $view->vars['reference_field'] =  $options['reference_field'] ?: null;
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                   'model_manager'     => $this->modelManager,
                   'class'             => $this->class,
                   'parent'            => 'text',
                   'reference_field'   => null,
                   'link_coordinates'  => null,
//                   'x1'                => null,
//                   'y1'                => null,
//                   'x2'                => null,
//                   'y2'                => null,
               ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'rz_type_tutorial_screenshot';
    }
}
