<?php

namespace Rz\TutorialBundle\Model;

interface UserHasTrainingInterface
{
    /**
     * @param boolean $isActive
     *
     * @return void
     */
    public function setIsActive($isActive);

    /**
     * @return boolean
     */
    public function getIsActive();

    /**
     * @param \Sonata\UserBundle\Model\UserInterface $user
     *
     * @return void
     */
    public function setUser(\Sonata\UserBundle\Model\UserInterface $user = null);

    /**
     * @return TutorialInterface
     */
    public function getUser();

    /**
     * @param TrainingInterface $training
     *
     * @return void
     */
    public function setTraining(TrainingInterface $training = null);

    /**
     * @return TrainingInterface
     */
    public function getTraining();

    /**
     * @param int $position
     *
     * @return int
     */
    public function setPosition($position);

    /**
     * @return int
     */
    public function getPosition();

    /**
     * @return void
     */
    public function __toString();
}
