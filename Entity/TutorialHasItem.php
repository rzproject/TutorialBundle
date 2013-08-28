<?php

namespace Rz\TutorialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rz\TutorialBundle\Model\TutorialHasItem as ModelTutorialHasItem;

/**
 * Tutorial
 */
class TutorialHasItem extends ModelTutorialHasItem
{
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
