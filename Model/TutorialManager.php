<?php

namespace Rz\TutorialBundle\Model;

abstract class TutorialManager implements TutorialManagerInterface
{
    /**
     * @var string
     */
    protected $class;

    /**
     * Creates an empty media instance
     *
     * @return Tutorial
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
     * @return Tutorial
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
     * @return Tutorial
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
