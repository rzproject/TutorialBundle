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
     * {@inheritdoc}
     */
    public function setTraining ($training)
    {
        $this->training = $training;
    }

    /**
     * {@inheritdoc}
     */
    public function getTraining ()
    {
        return $this->training;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser ($user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser ()
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setAccomplished ($accomplished)
    {
        $this->accomplished = $accomplished;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccomplished ()
    {
        return $this->accomplished;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt ($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt ()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrent ($current)
    {
        $this->current = $current;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrent ()
    {
        return $this->current;
    }

    /**
     * {@inheritdoc}
     */
    public function setTotal ($total)
    {
        $this->total = $total;
    }

    /**
     * {@inheritdoc}
     */
    public function getTotal ()
    {
        return $this->total;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt ($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * {@inheritdoc}
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
