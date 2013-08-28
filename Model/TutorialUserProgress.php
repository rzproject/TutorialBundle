<?php

namespace Rz\TutorialBundle\Model;


abstract class TutorialUserProgress implements TutorialUserProgressInterface
{
    protected $trainingUserProgress;
    protected $tutorial;
    protected $accomplished;
    protected $started;
    protected $ended;
    protected $elapseTime;
    protected $createdAt;
    protected $updatedAt;

    /**
     * {@inheritdoc}
     */
    public function setTrainingUserProgress ($trainingUserProgress)
    {
        $this->trainingUserProgress = $trainingUserProgress;
    }

    /**
     * {@inheritdoc}
     */
    public function getTrainingUserProgress ()
    {
        return $this->trainingUserProgress;
    }

    /**
     * {@inheritdoc}
     */
    public function setTutorial ($tutorial)
    {
        $this->tutorial = $tutorial;
    }

    /**
     * {@inheritdoc}
     */
    public function getTutorial ()
    {
        return $this->tutorial;
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
    public function setElapseTime ($elapseTime)
    {
        $this->elapseTime = $elapseTime;
    }

    /**
     * {@inheritdoc}
     */
    public function getElapseTime ()
    {
        return $this->elapseTime;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnded ($ended)
    {
        $this->ended = $ended;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnded ()
    {
        return $this->ended;
    }

    /**
     * {@inheritdoc}
     */
    public function setStarted ($started)
    {
        $this->started = $started;
    }

    /**
     * {@inheritdoc}
     */
    public function getStarted ()
    {
        return $this->started;
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
}
