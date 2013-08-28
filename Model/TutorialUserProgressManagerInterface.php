<?php

namespace Rz\TutorialBundle\Model;

interface TutorialUserProgressManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function create();

    /**
     * {@inheritdoc}
     */
    public function delete(TutorialUserProgressInterface $tutorialUserProgress);

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
    public function save(TutorialUserProgressInterface $tutorialUserProgress);
}
