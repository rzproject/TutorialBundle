<?php

namespace Rz\TutorialBundle\Model;

interface TutorialManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function create();

    /**
     * {@inheritdoc}
     */
    public function delete(TutorialInterface $tutorial);

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria);

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria);

    /**
     * {@inheritdoc}
     */
    public function getClass();

    /**
     * {@inheritdoc}
     */
    public function save(TutorialInterface $tutorial);
}
