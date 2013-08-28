<?php

namespace Rz\TutorialBundle\Model;

abstract class TutorialItemManager implements TutorialItemManagerInterface
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * Creates an empty media instance
     *
     * @return TutorialItem
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
     * @return TutorialItem
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
     * @return TutorialItem
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
