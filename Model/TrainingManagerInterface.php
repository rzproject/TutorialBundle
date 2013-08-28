<?php

namespace Rz\TutorialBundle\Model;

interface TrainingManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function create();

    /**
     * {@inheritdoc}
     */
    public function delete(TrainingInterface $training);

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria);

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria);

    /**
     * {@inheritdoc}
     */
    public function getClass();

    /**
     * {@inheritdoc}
     */
    public function save(TrainingInterface $training);
}
