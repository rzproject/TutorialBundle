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
     * @param mixed $trainingUserProgress
     */
    public function setTrainingUserProgress ($trainingUserProgress)
    {
        $this->trainingUserProgress = $trainingUserProgress;
    }

    /**
     * @return mixed
     */
    public function getTrainingUserProgress ()
    {
        return $this->trainingUserProgress;
    }

    /**
     * @param mixed $tutorial
     */
    public function setTutorial ($tutorial)
    {
        $this->tutorial = $tutorial;
    }

    /**
     * @return mixed
     */
    public function getTutorial ()
    {
        return $this->tutorial;
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
     * @param mixed $elapseTime
     */
    public function setElapseTime ($elapseTime)
    {
        $this->elapseTime = $elapseTime;
    }

    /**
     * @return mixed
     */
    public function getElapseTime ()
    {
        return $this->elapseTime;
    }

    /**
     * @param mixed $ended
     */
    public function setEnded ($ended)
    {
        $this->ended = $ended;
    }

    /**
     * @return mixed
     */
    public function getEnded ()
    {
        return $this->ended;
    }

    /**
     * @param mixed $started
     */
    public function setStarted ($started)
    {
        $this->started = $started;
    }

    /**
     * @return mixed
     */
    public function getStarted ()
    {
        return $this->started;
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
}
