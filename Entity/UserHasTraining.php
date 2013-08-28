<?php

namespace Rz\TutorialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rz\TutorialBundle\Model\UserHasTraining as ModelUserHasTraining;

/**
 * Tutorial
 */
class UserHasTraining extends ModelUserHasTraining
{
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
