<?php

namespace Rz\TutorialBundle\Model;


interface TutorialUserProgressInterface
{
    /**
     * @param mixed $accomplished
     */
    public function setAccomplished ($accomplished);

    /**
     * @return mixed
     */
    public function getAccomplished ();

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt ($createdAt);

    /**
     * @return mixed
     */
    public function getCreatedAt ();

    /**
     * @param mixed $elapseTime
     */
    public function setElapseTime ($elapseTime);

    /**
     * @return mixed
     */
    public function getElapseTime ();

    /**
     * @param mixed $ended
     */
    public function setEnded ($ended);

    /**
     * @return mixed
     */
    public function getEnded ();

    /**
     * @param mixed $started
     */
    public function setStarted ($started);

    /**
     * @return mixed
     */
    public function getStarted ();

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt ($updatedAt);

    /**
     * @return mixed
     */
    public function getUpdatedAt ();
}
