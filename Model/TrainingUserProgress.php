<?php

namespace Rz\TutorialBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;


abstract class TrainingUserProgress implements TrainingUserProgressInterface
{
    protected $user;
    protected $training;
    protected $tutorialUserProgress;
    protected $accomplished;
    protected $total;
    protected $current;
    protected $createdAt;
    protected $updatedAt;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        $this->tutorialUserProgress = new ArrayCollection();
    }

    /**
     * @param mixed $training
     */
    public function setTraining ($training)
    {
        $this->training = $training;
    }

    /**
     * @return mixed
     */
    public function getTraining ()
    {
        return $this->training;
    }

    /**
     * @param mixed $user
     */
    public function setUser ($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser ()
    {
        return $this->user;
    }

    /**
     * @param mixed $accomplished
     */
    public function setAccomplished ($accomplished)
    {
        $this->accomplished = $accomplished;
    }

    /**
     * @return mixed
     */
    public function getAccomplished ()
    {
        return $this->accomplished;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt ($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt ()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $current
     */
    public function setCurrent ($current)
    {
        $this->current = $current;
    }

    /**
     * @return mixed
     */
    public function getCurrent ()
    {
        return $this->current;
    }

    /**
     * @param mixed $total
     */
    public function setTotal ($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getTotal ()
    {
        return $this->total;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt ($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt ()
    {
        return $this->updatedAt;
    }


    /**
     * {@inheritdoc}
     */
    public function setTutorialUserProgress($tutorialUserProgress)
    {
        $this->tutorialUserProgress = new ArrayCollection();

        if($tutorialUserProgress) {
            foreach ($tutorialUserProgress as $tup) {
                $this->addTutorialUserProgress($tup);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTutorialUserProgress()
    {
        return $this->tutorialUserProgress;
    }

    /**
     * {@inheritdoc}
     */
    public function addTutorialUserProgress(TutorialUserProgressInterface $tutorialUserProgress)
    {
        $tutorialUserProgress->setTraining($this);
        $this->tutorialUserProgress[] = $tutorialUserProgress;
    }

    /**
     * {@inheritdoc}
     */
    public function removeTutorialUserProgress(TutorialUserProgressInterface $tutorialUserProgress)
    {
        $this->tutorialUserProgress->removeElement($tutorialUserProgress);
    }

}
