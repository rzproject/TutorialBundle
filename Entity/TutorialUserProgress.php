<?php

namespace Rz\TutorialBundle\Entity;
use Rz\TutorialBundle\Model\TutorialUserProgress as BaseTutorialUserProgress;

class TutorialUserProgress extends BaseTutorialUserProgress
{
    public function __toString() {
        return $this->getTrainingUserProgress()->getTraining()->getTitle().'-'.$this->getTutorial()->getTitle() ?: 'n/a';
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
