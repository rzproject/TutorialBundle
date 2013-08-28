<?php

namespace Rz\TutorialBundle\Model;

interface TutorialItemManagerInterface
{
    /**
     * Creates an empty tutorialItem instance
     *
     * @return TutorialItemInterface
     */
    public function create();

    /**
     * Deletes a tutorialItem
     *
     * @param TutorialItemInterface $tutorialItem
     *
     * @return void
     */
    public function delete(TutorialItemInterface $tutorialItem);

    /**
     * Finds many tutorialItem by the given criteria
     *
     * @param array $criteria
     *
     * @return TutorialItemInterface
     */
    public function findBy(array $criteria);

    /**
     * Finds one tutorialItem by the given criteria
     *
     * @param array $criteria
     *
     * @return TutorialItemInterface
     */
    public function findOneBy(array $criteria);

    /**
     * Returns the tutorialItem's fully qualified class name
     *
     * @return string
     */
    public function getClass();

    /**
     * @param TutorialItemInterface $tutorialItem
     *
     * @return void
     */
    public function save(TutorialItemInterface $tutorialItem);
}
