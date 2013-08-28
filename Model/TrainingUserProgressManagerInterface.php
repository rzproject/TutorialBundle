<?php

namespace Rz\TutorialBundle\Model;

interface TrainingUserProgressManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function create();

    /**
     * {@inheritdoc}
     */
    public function delete(TrainingUserProgressInterface $trainingUserProgress);

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
    public function save(TrainingUserProgressInterface $trainingUserProgress);
}
