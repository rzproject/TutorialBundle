<?php

namespace Rz\TutorialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rz\TutorialBundle\Model\Training as ModelTraining;

/**
 * Training
 */
class Training extends ModelTraining
{
    public function __toString() {
        return $this->getTitle() ?: 'n/a';
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
