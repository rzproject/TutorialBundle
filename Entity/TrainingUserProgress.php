<?php

namespace Rz\TutorialBundle\Entity;
use Rz\TutorialBundle\Model\TrainingUserProgress as BaseTrainingUserProgress;

class TrainingUserProgress extends BaseTrainingUserProgress
{
    public function __toString() {
        return $this->getUser()->getUsername().'-'.$this->getTraining()->getTitle() ?: 'n/a';
    }

    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
    }

    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime);
    }
}
