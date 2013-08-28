<?php

namespace Rz\TutorialBundle\Model;

interface TrainingHasTutorialInterface
{
    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled);

    /**
     * {@inheritdoc}
     */
    public function getEnabled();

    /**
     * {@inheritdoc}
     */
    public function setTutorial(TutorialInterface $tutorial = null);

    /**
     * {@inheritdoc}
     */
    public function getTutorial();

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
