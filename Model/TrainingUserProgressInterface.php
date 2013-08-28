<?php

namespace Rz\TutorialBundle\Model;


interface TrainingUserProgressInterface
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
     * @param mixed $current
     */
    public function setCurrent ($current);

    /**
     * @return mixed
     */
    public function getCurrent ();

    /**
     * @param mixed $total
     */
    public function setTotal ($total);

    /**
     * @return mixed
     */
    public function getTotal ();

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt ($updatedAt);

    /**
     * @return mixed
     */
    public function getUpdatedAt ();
}
