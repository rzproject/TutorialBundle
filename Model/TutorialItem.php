<?php

namespace Rz\TutorialBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;


class TutorialItem implements TutorialItemInterface
{
    protected $title;
    protected $description;
    protected $content;
    protected $linkCoordinates;
    protected $media;
    protected $tutorialHasItems;
    protected $updatedAt;
    protected $createdAt;

    /**
     * {@inheritdoc}
     */
    public function setDescription ($description)
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription ()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setContent ($link)
    {
        $this->content = $link;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent ()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function setLinkCoordinates ($linkCoordinates)
    {
        $this->linkCoordinates = $linkCoordinates;
    }

    /**
     * {@inheritdoc}
     */
    public function getLinkCoordinates ()
    {
        return $this->linkCoordinates;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle ($title)
    {
        $this->title = $title;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle ()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function setTutorialHasItems($tutorialHasItems)
    {
        $this->tutorialHasItems = $tutorialHasItems;
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
    public function setMedia(\Sonata\MediaBundle\Model\Media $media = null)
    {
        $this->media = $media;
    }

    /**
     * {@inheritdoc}
     */
    public function getMedia()
    {
        return $this->media;
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
