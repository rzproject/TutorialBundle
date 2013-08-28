<?php

namespace Rz\TutorialBundle\Model;

interface UserHasTrainingInterface
{
    /**
     * {@inheritdoc}
     */
    public function setIsActive($isActive);

    /**
     * {@inheritdoc}
     */
    public function getIsActive();

    /**
     * {@inheritdoc}
     */
    public function setUser(\Sonata\UserBundle\Model\UserInterface $user = null);

    /**
     * {@inheritdoc}
     */
    public function getUser();

    /**
     * {@inheritdoc}
     */
    public function setTraining(TrainingInterface $training = null);

    /**
     * {@inheritdoc}
     */
    public function getTraining();

    /**
     * {@inheritdoc}
     */
    public function setPosition($position);

    /**
     * {@inheritdoc}
     */
    public function getPosition();

    /**
     * {@inheritdoc}
     */
    public function __toString();
}
