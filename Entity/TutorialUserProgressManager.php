<?php

namespace Rz\TutorialBundle\Entity;

use Rz\TutorialBundle\Model\TutorialUserProgressManager as ModelTutorialUserProgressManager;
use Rz\TutorialBundle\Model\TutorialUserProgressInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query;
use Doctrine\ORM\NoResultException;

class TutorialUserProgressManager extends ModelTutorialUserProgressManager
{
    /**
     * {@inheritdoc}
     */
    protected $em;

    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em    = $em;
        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function save(TutorialUserProgressInterface $tutorialUserProgress)
    {
        $this->em->persist($tutorialUserProgress);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(TutorialUserProgressInterface $tutorialUserProgress)
    {
        $this->em->remove($tutorialUserProgress);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function createTutorialProgress($trainingUserProgress, $tutorial) {

        $progress = $this->findLatestTutorialProgress($trainingUserProgress,$tutorial);

        if(!$progress) {
            $progress = $this->create();
            $progress->setTutorial($tutorial);
            $progress->setTrainingUserProgress($trainingUserProgress);
            $progress->setStarted(new \DateTime());
            $this->save($progress);
        } else {
            $interval = $progress->getUpdatedAt()->diff(new \DateTime());
            $seconds = $interval->days*86400 + $interval->h*3600
                + $interval->i*60 + $interval->s;

            if ($seconds > 1800) {
                $progress = $this->create();
                $progress->setTutorial($tutorial);
                $progress->setTrainingUserProgress($trainingUserProgress);
                $progress->setStarted(new \DateTime());
                $this->save($progress);
            }
        }
        return $progress;
    }

    /**
     * {@inheritdoc}
     */
    public function updateTutorialProgress($trainingUserProgress, $tutorial) {

        $progress = $this->findLatestTutorialProgress($trainingUserProgress,$tutorial);

        if($progress) {
            $endDate = new \DateTime();
            $progress->setEnded($endDate);

            //compute elapse time
            $interval = $progress->getStarted()->diff($endDate);
            $progress->setElapseTime($interval->format('%H:%I:%S'));
            $progress->setAccomplished(true);
            $this->save($progress);
            return $progress;
        }
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function findLatestTutorialProgress($trainingUserProgress, $tutorial)
    {
        $parameters = array();

        $query = $this->em->getRepository($this->class)
                 ->createQueryBuilder('tup')
                 ->select('tup')
                 ->orderby('tup.updatedAt', 'DESC');

        if (isset($trainingUserProgress)) {
            $query->andWhere('tup.trainingUserProgress = :trainingUserProgress');
            $parameters['trainingUserProgress'] = $trainingUserProgress;
        }

        if (isset($tutorial)) {
            $query->andWhere('tup.tutorial = :tutorial');
            $parameters['tutorial'] = $tutorial;
        }

        $query->andWhere('tup.ended is null');

        $query->setParameters($parameters);
        $query->setMaxResults(1);

        try{
            return $query->getQuery()->getSingleResult();
        } catch(NoResultException $noResultExecption) {
            return null;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findTotalTutorialProgress($trainingUserProgress)
    {
        $parameters = array();

        $query = $this->em->getRepository($this->class)
                 ->createQueryBuilder('tup')
                 ->select('COUNT (DISTINCT tup.tutorial)');

        if (isset($trainingUserProgress)) {
            $query->andWhere('tup.trainingUserProgress = :trainingUserProgress');
            $parameters['trainingUserProgress'] = $trainingUserProgress;
        }

        $query->setParameters($parameters);
        $query->setMaxResults(1);

        try{
            $result = $query->getQuery()->getSingleResult();
            return $result[1];
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
