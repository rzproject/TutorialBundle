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
     * @param mixed $description
     */
    public function setDescription ($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription ()
    {
        return $this->description;
    }

    /**
     * @param mixed $link
     */
    public function setContent ($link)
    {
        $this->content = $link;
    }

    /**
     * @return mixed
     */
    public function getContent ()
    {
        return $this->content;
    }

    /**
     * @param mixed $linkCoordinates
     */
    public function setLinkCoordinates ($linkCoordinates)
    {
        $this->linkCoordinates = $linkCoordinates;
    }

    /**
     * @return mixed
     */
    public function getLinkCoordinates ()
    {
        return $this->linkCoordinates;
    }

    /**
     * @param mixed $title
     */
    public function setTitle ($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
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
     * Set media
     *
     * @param \Sonata\MediaBundle\Model\Media $media
     */
    public function setMedia(\Sonata\MediaBundle\Model\Media $media = null)
    {
        $this->media = $media;
    }

    /**
     * Get tutorial
     *
     * @return \Sonata\MediaBundle\Model\Media
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
