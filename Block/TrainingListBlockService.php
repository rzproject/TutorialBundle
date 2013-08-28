<?php


namespace Rz\TutorialBundle\Block;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

use Rz\TutorialBundle\Model\TrainingManagerInterface;
use Rz\TutorialBundle\Model\TrainingInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Form;
use Symfony\Component\DependencyInjection\ContainerInterface;


class TrainingListBlockService extends BaseBlockService
{
    protected $trainingAdmin;
    protected $trainingManager;

    /**
     * @param string $name
     * @param \Symfony\Component\Templating\EngineInterface $templating
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param \Rz\TutorialBundle\Model\TrainingManagerInterface
*/
    public function __construct($name, EngineInterface $templating, ContainerInterface $container, TrainingManagerInterface $trainingManager)
    {
        parent::__construct($name, $templating);

        $this->trainingManager = $trainingManager;
        $this->container    = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Training List';
    }

    /**
     * @return mixed
     */
    public function getTutorialAdmin()
    {
        if (!$this->trainingAdmin) {
            $this->trainingAdmin = $this->container->get('rz_tutorial.admin.training');
        }

        return $this->trainingAdmin;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                                   'title'    => 'Tutorial Block List Title',
                                   'maxPerPage'  => 10,
                                   'template' => 'RzTutorialBundle:Block:block_tutorial_list.html.twig'
                               ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', 'sonata_type_immutable_array', array(
                                       'keys' => array(
                                           array('title', 'text', array('required' => true)),
                                           array('maxPerPage', 'text', array('required' => true)),
                                       )
                                   ));
    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse($blockContext->getTemplate(),
                                     array(
                                         'block'     => $blockContext->getBlock(),
                                         'settings'  => $blockContext->getBlock()->getSettings()
                                     ), $response);
    }

    /**
     * {@inheritdoc}
     */
    public function load(BlockInterface $block)
    {
        $settings = $block->getSettings();
        $tutorials = $this->trainingManager->getPager(array(), 1, $settings['maxPerPage']);
        $block->setSetting('tutorials', $tutorials);
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist(BlockInterface $block)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate(BlockInterface $block)
    {
    }
}
