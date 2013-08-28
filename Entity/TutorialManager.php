<?php

namespace Rz\TutorialBundle\Entity;

use Rz\TutorialBundle\Model\TutorialManager as ModelTutorialManager;
use Rz\TutorialBundle\Model\TutorialInterface;

use Sonata\DoctrineORMAdminBundle\Datagrid\Pager;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\Expr;

use Doctrine\ORM\Query;

class TutorialManager extends ModelTutorialManager
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
    public function save(TutorialInterface $tutorial)
    {
        $this->em->persist($tutorial);
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
    public function delete(TutorialInterface $tutorial)
    {
        $this->em->remove($tutorial);
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
    public function getTutorialGroupByCategory()
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
