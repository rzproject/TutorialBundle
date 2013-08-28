<?php

namespace Rz\TutorialBundle\Entity;

use Rz\TutorialBundle\Model\TrainingManager as ModelTrainingManager;
use Rz\TutorialBundle\Model\TrainingInterface;

use Sonata\DoctrineORMAdminBundle\Datagrid\Pager;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\Expr;

use Doctrine\ORM\Query;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class TrainingManager extends ModelTrainingManager
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
    public function save(TrainingInterface $training)
    {
        $this->em->persist($training);
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
    public function delete(TrainingInterface $training)
    {
        $this->em->remove($training);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getPager(array $criteria, $page = 0, $maxPerPage = 10)
    {
        $query = $this->em->getRepository($this->class)
                 ->createQueryBuilder('t')
                 ->select('t')
                 ->orderby('t.title', 'DESC');

        $pager = new Pager();
        $pager->setMaxPerPage($maxPerPage);
        $pager->setQuery(new ProxyQuery($query));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomPager(array $criteria, $page = 0, $maxPerPage = 10) {
        $query = $this->em->createQuery(sprintf('
                                    SELECT t, uht FROM %s t
                                    LEFT JOIN t.userHasTrainings uht
                                    WHERE uht.user = :user
                                    ORDER BY t.createdAt ASC', $this->class))
                          ->setParameter('user', $criteria['user']);

        try {
            return new Pagerfanta(new DoctrineORMAdapter($query));
        } catch (NoResultException $e) {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTrainingGroupByCategory()
    {
        $query = $this->em->getRepository($this->class)
                 ->createQueryBuilder('t')
                 ->orderby('t.title', 'DESC');

        return $query->getQuery()->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBySlug($slug)
    {
        try {
            $repository = $this->em->getRepository($this->class);

            $query = $repository->createQueryBuilder('p');
            $parameters = array();

            if (isset($slug)) {
                $query->andWhere('p.slug = :slug');
                $parameters['slug'] = $slug;
            }

            if (count($parameters) == 0) {
                return null;
            }
            $query->setParameters($parameters);
            return $query->getQuery()->getSingleResult();

        } catch (NoResultException $e) {
            return null;
        }
    }
}
