<?php


namespace Rz\TutorialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Rz\TutorialBundle\Model\TrainingInterface;

class TrainingController extends Controller
{
    /**
     * @throws NotFoundHttpException
     *
     * @return Response
     */
    public function listAction()
    {
        return $this->renderTrainings();
    }

    /**
     *
     * @param $page
     *
     * @return Response
     */
    public function listPageAction($page)
    {
        return $this->renderTrainings(array(), array('page'=>$page));
    }

    public function listTutorialsAction($slug)
    {
        if (!$slug) {
            throw new NotFoundHttpException('Unable to find the tutorial!');
        }
        return $this->renderTutorials($slug);
    }

    public function viewTutorialAction($slug, $tutorialSlug)
    {
        if (!$slug || !$tutorialSlug) {
            throw new NotFoundHttpException('Unable to find the tutorial!');
        }

        $training = $this->getTrainingManager()->findOneBySlug($slug);
        if (!$training) {
            throw new NotFoundHttpException('Unable to find the training!');
        }

        $tutorial = $this->getTutorialManager()->findOneBySlug($tutorialSlug);

        if (!$tutorial) {
            throw new NotFoundHttpException('Unable to find the tutorial!');
        }

        if (!$this->getUserHasTrainingManager()->hasTutorialAccess($this->getUser(), $tutorial)) {
            throw new AccessDeniedException('You are not subscribe to access the tutorial!');
        };

        //log activity
        //TODO: create event listeners
        $trainingUserProgress = $this->getTrainingUserProgressManager()->createTrainingProgress($training, $this->getUser());
        $tutorialUserProgress = $this->getTutorialUserProgressManager()->createTutorialProgress($trainingUserProgress, $tutorial);

        if ($seoPage = $this->getSeoPage()) {
            $seoPage
            ->setTitle($tutorial->getTitle())
            ->addMeta('name', 'description', $tutorial->getDescription())
            ->addMeta('property', 'og:title', $tutorial->getTitle())
            ->addMeta('property', 'og:type', 'tutorial')
            ->addMeta('property', 'og:url',  $this->generateUrl('rz_tutorial_training_tutorial',
                                                                array('slug'  => $slug, 'tutorialSlug'  => $tutorial->getSlug()),
                                                                true))
            ->addMeta('property', 'og:description', $tutorial->getDescription())
            ;
        }
        return $this->render('RzTutorialBundle:Training:tutorial.html.twig',array('tutorial' => $tutorial, 'trainingSlug' => $slug));
    }

    public function summaryTutorialAction($slug, $tutorialSlug)
    {
        if (!$slug || !$tutorialSlug) {
            throw new NotFoundHttpException('Unable to find the tutorial!');
        }

        $training = $this->getTrainingManager()->findOneBySlug($slug);
        if (!$training) {
            throw new NotFoundHttpException('Unable to find the training!');
        }

        $tutorial = $this->getTutorialManager()->findOneBySlug($tutorialSlug);

        if (!$this->getUserHasTrainingManager()->hasTutorialAccess($this->getUser(), $tutorial)) {
            throw new AccessDeniedException('You are not subscribe to access the tutorial!');
        };


        if (!$tutorial) {
            throw new NotFoundHttpException('Unable to find the tutorial!');
        }

        //log activity
        //TODO: create event listeners
        $trainingUserProgress = $this->getTrainingUserProgressManager()->findOneBy(array('training'=>$training, 'user'=>$this->getUser()));
        $tutorialUserProgress = $this->getTutorialUserProgressManager()->updateTutorialProgress($trainingUserProgress, $tutorial);
        if($tutorialUserProgress) {
            $count = $this->getTutorialUserProgressManager()->findTotalTutorialProgress($trainingUserProgress);
            $this->getTrainingUserProgressManager()->updateTrainingProgress($trainingUserProgress, $count);
        }

        if ($seoPage = $this->getSeoPage()) {
            $seoPage
            ->setTitle($tutorial->getTitle())
            ->addMeta('name', 'description', $tutorial->getDescription())
            ->addMeta('property', 'og:title', $tutorial->getTitle())
            ->addMeta('property', 'og:type', 'tutorial')
            ->addMeta('property', 'og:url',  $this->generateUrl('rz_tutorial_training_tutorial',
                                                                array('slug'  => $slug, 'tutorialSlug'  => $tutorial->getSlug()),
                                                                true))
            ->addMeta('property', 'og:description', $tutorial->getDescription())
            ;
        }
        return $this->render('RzTutorialBundle:Training:summary.html.twig',
                             array('tutorial' => $tutorial,
                                   'trainingSlug' => $slug)
        );
    }



    /**
     * @param array $criteria
     * @param array $parameters
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderTrainings(array $criteria = array(), array $parameters = array())
    {
        $page = array_key_exists('page', $parameters) ? $parameters['page'] : 1;

        $user = $this->getUser();

        $pager = $this->getTrainingManager()->getCustomPager(array('user'=>$user), $page);
        $pager->setMaxPerPage(10);
        $pager->setCurrentPage($page, false, true);

        $parameters = array_merge(array('pager' => $pager), $parameters);

        $response = $this->render('RzTutorialBundle:Training:list.html.twig', $parameters);

        return $response;
    }


    /**
     * @param $slug
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderTutorials($slug)
    {
        if (!$slug) {
            throw new NotFoundHttpException('Unable to find the tutorial!');
        }

        $training = $this->getTrainingManager()->findOneBySlug($slug);

        if (!$this->getUserHasTrainingManager()->hasTrainingAccess($this->getUser(), $training)) {
            throw new AccessDeniedException('You are not subscribe to access the training!');
        };

        $response = $this->render('RzTutorialBundle:Training:tutorials_list.html.twig', array('training'=>$training));

        return $response;
    }
    /**
     * @return \Sonata\SeoBundle\Seo\SeoPageInterface
     */
    public function getSeoPage()
    {
        if ($this->has('sonata.seo.page')) {
            return $this->get('sonata.seo.page');
        }

        return null;
    }

    public function getSiteSelector()
    {
        if ($this->has('sonata.page.site.selector')) {
            return $this->get('sonata.page.site.selector');
        }

        return null;
    }

    public function getCmsManagerSelector()
    {
        if ($this->has('sonata.page.cms_manager_selector')) {
            return $this->get('sonata.page.cms_manager_selector');
        }

        return null;
    }


    /**
     * @return \Rz\TutorialBundle\Model\TrainingManagerInterface
     */
    protected function getTrainingManager()
    {
        return $this->get('rz_tutorial.manager.training');
    }

    /**
     * @return \Rz\TutorialBundle\Model\TutorialManagerInterface
     */
    protected function getTutorialManager()
    {
        return $this->get('rz_tutorial.manager.tutorial');
    }

    /**
     * @return \Rz\TutorialBundle\Model\UserHasTrainingManagerInterface
     */
    protected function getUserHasTrainingManager()
    {
        return $this->get('rz_tutorial.manager.user_has_training');
    }

    /**
     * @return \Rz\TutorialBundle\Model\UserHasTrainingManagerInterface
     */
    protected function getUserManager()
    {
        return $this->get('fos_user.user_manager');
    }

    protected function getTrainingUserProgressManager(){
        return $this->get('rz_tutorial.manager.training_user_progress');
    }

    protected function getTutorialUserProgressManager(){
        return $this->get('rz_tutorial.manager.tutorial_user_progress');
    }
}
