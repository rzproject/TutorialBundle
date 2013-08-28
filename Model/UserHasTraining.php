<?php

namespace Rz\TutorialBundle\Model;

abstract class UserHasTraining implements UserHasTrainingInterface
{
    protected $user;

    protected $training;

    protected $isActive;

    protected $position;

    protected $updatedAt;

    protected $createdAt;

    public function __construct()
    {
        $this->position = 0;
        $this->isActive  = false;
    }

    /**
     * {@inheritdoc}
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * {@inheritdoc}
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(\Sonata\UserBundle\Model\UserInterface $user = null)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser()
    {
        return $this->user;
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
        return $this->getUser().' | '.$this->getTraining();
    }
}
