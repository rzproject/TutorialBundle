<?php

namespace Rz\TutorialBundle\Entity;

use Rz\TutorialBundle\Model\TrainingUserProgressManager as ModelTrainingUserProgressManager;
use Rz\TutorialBundle\Model\TrainingUserProgressInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query;

class TrainingUserProgressManager extends ModelTrainingUserProgressManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     * @param string                      $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em    = $em;
        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function save(TrainingUserProgressInterface $trainingUserProgress)
    {
        $this->em->persist($trainingUserProgress);
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
    public function delete(TrainingUserProgressInterface $trainingUserProgress)
    {
        $this->em->remove($trainingUserProgress);
        $this->em->flush();
    }

    public function createTrainingProgress($training, $user) {
        $progress = $this->findOneBy(array('training'=>$training, 'user'=>$user));

        if(!$progress) {
            $progress = $this->create();
            $progress->setTraining($training);
            $progress->setUser($user);
            $progress->setTotal(count($training->getTrainingHasTutorials()));
            $progress->setCurrent(0);
            $this->save($progress);
        }

        return $progress;
    }

    public function updateTrainingProgress($progress, $count) {
        if($progress) {
            $progress->setCurrent($count);
            if ($count == $progress->getTotal()) {
                $progress->setAccomplished(true);
            }
            $this->save($progress);
        }
        return $progress;
    }
}
