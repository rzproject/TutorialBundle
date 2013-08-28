<?php

namespace Rz\TutorialBundle\Model;

interface TutorialHasItemInterface
{
    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled);

    /**
     * {@inheritdoc}
     */
    public function getEnabled();

    /**
     * {@inheritdoc}
     */
    public function setTutorial(TutorialInterface $tutorial = null);

    /**
     * {@inheritdoc}
     */
    public function getTutorial();

    /**
     * {@inheritdoc}
     */
    public function setTutorialItem(TutorialItemInterface $tutorialItem = null);

    /**
     * {@inheritdoc}
     */
    public function getTutorialItem();

    /**
     * {@inheritdoc}
     */
    public function setPosition($position);

    /**
     * {@inheritdoc}
     */
    public function getPosition();

    /**
     * {@inheritdoc}
     */
    public function __toString();
}
