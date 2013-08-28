<?php

namespace Rz\TutorialBundle\Model;

interface TutorialItemManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function create();

    /**
     * {@inheritdoc}
     */
    public function delete(TutorialItemInterface $tutorialItem);

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
    public function save(TutorialItemInterface $tutorialItem);
}
