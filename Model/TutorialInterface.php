<?php

namespace Rz\TutorialBundle\Model;


interface TutorialInterface
{
    public function getTitle();

    public function setTitle($title);

    public function getDescription();

    public function setDescription($description);

    public function getContent();

    public function setContent($title);

    public function getSlug();

    public function getPermalink();
}
