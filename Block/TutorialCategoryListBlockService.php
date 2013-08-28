<?php


namespace Rz\TutorialBundle\Block;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

use Rz\TutorialBundle\Model\CategoryManagerInterface;
use Rz\TutorialBundle\Model\TutorialManagerInterface;
use Rz\TutorialBundle\Model\CategoryInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Form;
use Symfony\Component\DependencyInjection\ContainerInterface;


class TutorialCategoryListBlockService extends BaseBlockService
{
    protected $categoryManager;
    protected $tutorialManager;
    protected $categoryAdmin;

    /**
     * @param string $name
     * @param \Symfony\Component\Templating\EngineInterface $templating
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param \Rz\TutorialBundle\Model\TutorialManagerInterface $tutorialManager
     */
    public function __construct($name,
                                EngineInterface $templating,
                                ContainerInterface $container,
                                CategoryManagerInterface $categoryManager,
                                TutorialManagerInterface $tutorialManager)
    {
        parent::__construct($name, $templating);

        $this->categoryManager = $categoryManager;
        $this->tutorialManager = $tutorialManager;
        $this->container    = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Tutorial Category List';
    }

    /**
     * @return mixed
     */
    public function getCategoryAdmin()
    {
        if (!$this->categoryAdmin) {
            $this->categoryAdmin = $this->container->get('rz_tutorial.admin.category');
        }

        return $this->categoryAdmin;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                                   'title'    => 'Tutorial Category List Title',
                                   'template' => 'RzTutorialBundle:Block:block_tutorial_category_list.html.twig'
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
        //add categories
        $categories = $this->categoryManager->fetchCategoriesTree();
        $block->setSetting('categories', $categories);
        //add tutorials
        $tutorialsList = $this->tutorialManager->getTutorialGroupByCategory();
        $tutorials = array();
        foreach($tutorialsList as $tutorial) {
            $tutorials[$tutorial->getCategory()->getId()][] = $tutorial;
        }
        $block->setSetting('tutorials', $tutorials);
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist(BlockInterface $block)
    {
        $settings = $block->getSettings();
//        if (!array_key_exists('categories', $settings)) {
//            $categories = $this->categoryManager->fetchCategoriesTree();
//            $block->setSetting('categories', $categories);
//        }
        if (!array_key_exists('title', $settings)) {
            $block->setSetting('title', 'Tutorial Category List Title');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate(BlockInterface $block)
    {
        $settings = $block->getSettings();
//        if (!array_key_exists('categories', $settings)) {
//            $categories = $this->categoryManager->fetchCategoriesTree();
//            $block->setSetting('categories', $categories);
//        }
        if (!array_key_exists('title', $settings)) {
            $block->setSetting('title', 'Tutorial Category List Title');
        }
    }
}
