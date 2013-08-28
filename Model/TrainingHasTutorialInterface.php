<?php

namespace Rz\TutorialBundle\Model;

interface TrainingHasTutorialInterface
{
    /**
     * @param boolean $enabled
     *
     * @return void
     */
    public function setEnabled($enabled);

    /**
     * @return boolean
     */
    public function getEnabled();

    /**
     * @param TutorialInterface $tutorial
     *
     * @return void
     */
    public function setTutorial(TutorialInterface $tutorial = null);

    /**
     * @return TutorialInterface
     */
    public function getTutorial();

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
