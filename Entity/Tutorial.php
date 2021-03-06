<?php

namespace Rz\TutorialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rz\TutorialBundle\Model\Tutorial as ModelTutorial;

/**
 * Tutorial
 */
class Tutorial extends ModelTutorial
{
    /**
     * {@inheritdoc}
     */
    public function __toString() {
        return $this->getTitle() ?: 'n/a';
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
