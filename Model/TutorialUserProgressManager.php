<?php

namespace Rz\TutorialBundle\Model;

abstract class TutorialUserProgressManager implements TutorialUserProgressManagerInterface
{
    /**
     * {@inheritdoc}
     */
    protected $class;

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
