<?php

namespace Rz\TutorialBundle\Entity;

use Rz\TutorialBundle\Model\UserHasTrainingManager as ModelUserHasTrainingManager;
use Rz\TutorialBundle\Model\UserHasTrainingInterface;

use Sonata\DoctrineORMAdminBundle\Datagrid\Pager;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\Expr;

use Doctrine\ORM\Query;

class UserHasTrainingManager extends ModelUserHasTrainingManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     * @param string                      $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em    = $em;
        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function save(UserHasTrainingInterface $userHasTraining)
    {
        $this->em->persist($userHasTraining);
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
    public function delete(UserHasTrainingInterface $userHasTraining)
    {
        $this->em->remove($userHasTraining);
        $this->em->flush();
    }


    public function getPager(array $criteria, $page = 0, $maxPerPage = 10)
    {
        $query = $this->em->getRepository($this->class)
                 ->createQueryBuilder('ut')
                 ->select('ut')
                 ->orderby('ut.position', 'ASC');

        $pager = new Pager();
        $pager->setMaxPerPage($maxPerPage);
        $pager->setQuery(new ProxyQuery($query));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    /**
     * {@inheritDoc}
     */
    public function hasTutorialAccess($user, $tutorial)
    {
        $query = $this->em->createQuery(sprintf('
                                    SELECT tut.title, uht, tht, t FROM %s uht
                                    LEFT JOIN uht.training t
                                    LEFT JOIN t.trainingHasTutorials tht
                                    LEFT JOIN tht.tutorial tut
                                    WHERE uht.user = :user
                                    AND tht.tutorial = :tutorial
                                    ORDER BY t.createdAt ASC', $this->class))
                 ->setParameters(array('user'=>$user, 'tutorial'=>$tutorial));


        try {
            return (count($query->getArrayResult()) > 0) ? true : false;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function hasTrainingAccess($user, $training)
    {
        $query = $this->em->createQuery(sprintf('
                                    SELECT uht FROM %s uht
                                    WHERE uht.user = :user
                                    AND uht.training = :training
                                    ORDER BY uht.createdAt ASC', $this->class))
                 ->setParameters(array('user'=>$user, 'training'=>$training));


        try {
            return (count($query->getArrayResult()) > 0) ? true : false;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
