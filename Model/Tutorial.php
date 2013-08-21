<?php

namespace Rz\TutorialBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Tutorial implements TutorialInterface
{
    protected $title;
    protected $description;
    protected $content;
    protected $slug;
    protected $permalink;
    protected $tutorialHasItems;
    protected $createdAt;
    protected $updatedAt;

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
        $this->title = $content;
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
    public function getPermalink() {
        return $this->permalink;
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
}
