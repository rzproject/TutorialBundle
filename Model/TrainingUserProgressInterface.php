<?php

namespace Rz\TutorialBundle\Model;


interface TrainingUserProgressInterface
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
    public function setCurrent ($current);

    /**
     * {@inheritdoc}
     */
    public function getCurrent ();

    /**
     * {@inheritdoc}
     */
    public function setTotal ($total);

    /**
     * {@inheritdoc}
     */
    public function getTotal ();

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt ($updatedAt);

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt ();
}
