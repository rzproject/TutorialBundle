<?php

namespace Rz\TutorialBundle\Model;

interface TutorialHasItemInterface
{
    /**
     * @param boolean $enabled
     *
     * @return void
     */
    public function setEnabled($enabled);

    /**
     * @return boolean
     */
    public function getEnabled();

    /**
     * @param TutorialInterface $tutorial
     *
     * @return void
     */
    public function setTutorial(TutorialInterface $tutorial = null);

    /**
     * @return TutorialInterface
     */
    public function getTutorial();

    /**
     * @param TutorialItemInterface $tutorialItem
     *
     * @return void
     */
    public function setTutorialItem(TutorialItemInterface $tutorialItem = null);

    /**
     * @return TutorialItemInterface
     */
    public function getTutorialItem();

    /**
     * @param int $position
     *
     * @return int
     */
    public function setPosition($position);

    /**
     * @return int
     */
    public function getPosition();

//    /**
//     * @param \DateTime|null $updatedAt
//     *
//     * @return void
//     */
//    public function setUpdatedAt(\DateTime $updatedAt = null);
//
//    /**
//     * @return \DateTime
//     */
//    public function getUpdatedAt();
//
//    /**
//     * @param \DateTime|null $createdAt
//     *
//     * @return void
//     */
//    public function setCreatedAt(\DateTime $createdAt = null);
//
//    /**
//     * @return void
//     */
//    public function getCreatedAt();

    /**
     * @return void
     */
    public function __toString();
}
