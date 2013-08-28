<?php

namespace Rz\TutorialBundle\Model;

interface TrainingManagerInterface
{
    /**
     * Creates an empty tutorial instance
     *
     * @return TrainingInterface
     */
    public function create();

    /**
     * Deletes a tutorial
     *
     * @param TrainingInterface $training
     *
     * @return void
     */
    public function delete(TrainingInterface $training);

    /**
     * Finds many tutorial by the given criteria
     *
     * @param array $criteria
     *
     * @return TrainingInterface
     */
    public function findBy(array $criteria);

    /**
     * Finds one tutorial by the given criteria
     *
     * @param array $criteria
     *
     * @return TrainingInterface
     */
    public function findOneBy(array $criteria);

    /**
     * Returns the tutorial's fully qualified class name
     *
     * @return string
     */
    public function getClass();

    /**
     * @param TrainingInterface $training
     *
     * @return void
     */
    public function save(TrainingInterface $training);
}
