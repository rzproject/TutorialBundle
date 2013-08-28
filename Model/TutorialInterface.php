<?php

namespace Rz\TutorialBundle\Model;


interface TutorialInterface
{
    /**
     * {@inheritdoc}
     */
    public function getTitle();

    /**
     * {@inheritdoc}
     */
    public function setTitle($title);

    /**
     * {@inheritdoc}
     */
    public function getDescription();

    /**
     * {@inheritdoc}
     */
    public function setDescription($description);

    /**
     * {@inheritdoc}
     */
    public function getContent();

    /**
     * {@inheritdoc}
     */
    public function setContent($content);

    /**
     * {@inheritdoc}
     */
    public function getSlug();
}
