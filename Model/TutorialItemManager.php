<?php

namespace Rz\TutorialBundle\Model;

abstract class TutorialItemManager implements TutorialItemManagerInterface
{
    /**
     * {@inheritdoc}
     */
    protected $class;

    /**
     * {@inheritdoc}
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria)
    {
        return $this->getRepository()->findBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }
}
