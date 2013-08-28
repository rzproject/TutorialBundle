<?php

namespace Rz\TutorialBundle\Model;

abstract class TrainingManager implements TrainingManagerInterface
{
    /**
     * @var string
     */
    protected $class;

    /**
     * Creates an empty media instance
     *
     * @return Training
     */
    public function create()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * Finds one media by the given criteria
     *
     * @param array $criteria
     *
     * @return Training
     */
    public function findOneBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }

    /**
     * Finds one media by the given criteria
     *
     * @param array $criteria
     *
     * @return Training
     */
    public function findBy(array $criteria)
    {
        return $this->getRepository()->findBy($criteria);
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}
