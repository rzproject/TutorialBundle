<?php

namespace Rz\TutorialBundle\Model;


interface TutorialItemInterface
{
    public function getTitle();

    public function setTitle($title);

    public function getDescription();

    public function setDescription($description);

    public function getContent();

    public function setContent($content);

    public function getLinkCoordinates();

    public function setLinkCoordinates($linkCoordinates);
}
