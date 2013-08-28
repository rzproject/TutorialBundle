<?php

namespace Rz\TutorialBundle\Model;

interface TutorialManagerInterface
{
    /**
     * Creates an empty tutorial instance
     *
     * @return TutorialInterface
     */
    public function create();

    /**
     * Deletes a tutorial
     *
     * @param TutorialInterface $tutorial
     *
     * @return void
     */
    public function delete(TutorialInterface $tutorial);

    /**
     * Finds many tutorial by the given criteria
     *
     * @param array $criteria
     *
     * @return TutorialInterface
     */
    public function findBy(array $criteria);

    /**
     * Finds one tutorial by the given criteria
     *
     * @param array $criteria
     *
     * @return TutorialInterface
     */
    public function findOneBy(array $criteria);

    /**
     * Returns the tutorial's fully qualified class name
     *
     * @return string
     */
    public function getClass();

    /**
     * @param TutorialInterface $tutorial
     *
     * @return void
     */
    public function save(TutorialInterface $tutorial);
}
