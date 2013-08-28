<?php

namespace Rz\TutorialBundle\Entity;

use Rz\TutorialBundle\Model\TrainingUserProgress as BaseTrainingUserProgress;

class TrainingUserProgress extends BaseTrainingUserProgress
{
    /**
     * {@inheritdoc}
     */
    public function __toString() {
        return $this->getUser()->getUsername().'-'.$this->getTraining()->getTitle() ?: 'n/a';
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime);
    }
}
