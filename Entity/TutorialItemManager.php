<?php

namespace Rz\TutorialBundle\Entity;

use Rz\TutorialBundle\Model\TutorialItemManager as ModelTutorialItemManager;
use Rz\TutorialBundle\Model\TutorialItemInterface;

use Sonata\DoctrineORMAdminBundle\Datagrid\Pager;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\Expr;

use Doctrine\ORM\Query;

class TutorialItemManager extends ModelTutorialItemManager
{
    /**
     * {@inheritdoc}
     */
    protected $em;

    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em    = $em;
        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function save(TutorialItemInterface $tutorialItem)
    {
        $this->em->persist($tutorialItem);
        $this->em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(TutorialItemInterface $tutorialItem)
    {
        $this->em->remove($tutorialItem);
        $this->em->flush();
    }
}
