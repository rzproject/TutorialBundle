<?php

namespace Rz\TutorialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rz\TutorialBundle\Model\Tutorial as ModelTutorial;

/**
 * Tutorial
 */
class Tutorial extends ModelTutorial
{
    public function __toString() {
        return $this->getDescription() ?: 'n/a';
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
