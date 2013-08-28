<?php

namespace Rz\TutorialBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Tutorial implements TutorialInterface
{
    protected $title;
    protected $description;
    protected $content;
    protected $slug;
    protected $tutorialHasItems;
    protected $trainingHasTutorials;
    protected $tutorialUserProgress;
    protected $createdAt;
    protected $updatedAt;
    protected $enabled;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        $this->tutorialHasItems = new ArrayCollection();
        $this->trainingHasTutorials = new ArrayCollection();
        $this->tutorialUserProgress = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
 * {@inheritdoc}
 */
    public function setTutorialHasItems($tutorialHasItems)
    {
        $this->tutorialHasItems = new ArrayCollection();

        foreach ($tutorialHasItems as $tutorialHasItem) {
            $this->addTutorialHasItems($tutorialHasItem);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTutorialHasItems()
    {
        return $this->tutorialHasItems;
    }

    /**
     * {@inheritdoc}
     */
    public function addTutorialHasItems(TutorialHasItemInterface $tutorialHasItem)
    {
        $tutorialHasItem->setTutorial($this);
        $this->tutorialHasItems[] = $tutorialHasItem;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled = false)
    {
        $this->enabled = $enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $trainingHasTutorials
     */
    public function setTrainingHasTutorials ($trainingHasTutorials)
    {
        $this->trainingHasTutorials = $trainingHasTutorials;
    }

    /**
     * @return mixed
     */
    public function getTrainingHasTutorials ()
    {
        return $this->trainingHasTutorials;
    }

    /**
     * {@inheritdoc}
     */
    public function setTutorialUserProgress($tutorialUserProgress)
    {
        $this->tutorialUserProgress = new ArrayCollection();

        if($tutorialUserProgress) {
            foreach (tutorialUserProgress as $tup) {
                $this->addTutorialUserProgress($tup);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTutorialUserProgress()
    {
        return $this->tutorialUserProgress;
    }

    /**
     * {@inheritdoc}
     */
    public function addTutorialUserProgress(TutorialUserProgressInterface $tutorialUserProgress)
    {
        $tutorialUserProgress->setTutorial($this);
        $this->tutorialUserProgress[] = $tutorialUserProgress;
    }

    /**
     * {@inheritdoc}
     */
    public function removeTutorialUserProgress(TutorialUserProgressInterface $tutorialUserProgress)
    {
        $this->tutorialUserProgress->removeElement($tutorialUserProgress);
    }
}
