<?php

namespace Rz\TutorialBundle\Model;

interface UserHasTrainingManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function create();

    /**
     * {@inheritdoc}
     */
    public function delete(UserHasTrainingInterface $userHasTraining);

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
    public function save(UserHasTrainingInterface $userHasTraining);
}
