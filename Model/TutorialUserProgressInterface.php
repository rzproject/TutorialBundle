<?php

namespace Rz\TutorialBundle\Model;


interface TutorialUserProgressInterface
{
    /**
     * {@inheritdoc}
     */
    public function setAccomplished ($accomplished);

    /**
     * {@inheritdoc}
     */
    public function getAccomplished ();

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt ($createdAt);

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt ();

    /**
     * {@inheritdoc}
     */
    public function setElapseTime ($elapseTime);

    /**
     * {@inheritdoc}
     */
    public function getElapseTime ();

    /**
     * {@inheritdoc}
     */
    public function setEnded ($ended);

    /**
     * {@inheritdoc}
     */
    public function getEnded ();

    /**
     * {@inheritdoc}
     */
    public function setStarted ($started);

    /**
     * {@inheritdoc}
     */
    public function getStarted ();

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt ($updatedAt);

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt ();
}
