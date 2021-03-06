<?php

namespace Rz\TutorialBundle\Model;

abstract class TrainingHasTutorial implements TrainingHasTutorialInterface
{
    protected $tutorial;

    protected $training;

    protected $position;

    protected $updatedAt;

    protected $createdAt;

    protected $enabled;

    public function __construct()
    {
        $this->position = 0;
        $this->enabled  = false;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function setTutorial(TutorialInterface $tutorial = null)
    {
        $this->tutorial = $tutorial;
    }

    /**
     * {@inheritdoc}
     */
    public function getTutorial()
    {
        return $this->tutorial;
    }

    /**
     * {@inheritdoc}
     */
    public function setTraining(TrainingInterface $training = null)
    {
        $this->training = $training;
    }

    /**
     * {@inheritdoc}
     */
    public function getTraining()
    {
        return $this->training;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getTutorial().' | '.$this->getTraining();
    }
}
