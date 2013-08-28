<?php

namespace Rz\TutorialBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Training implements TrainingInterface
{
    protected $title;
    protected $description;
    protected $content;
    protected $slug;
    protected $createdAt;
    protected $updatedAt;
    protected $publishStart;
    protected $publishEnd;
    protected $isPublished;
    protected $trainingHasTutorials;
    protected $userHasTrainings;
    protected $trainingUserProgress;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        $this->trainingHasTutorials = new ArrayCollection();
        $this->userHasTrainings = new ArrayCollection();
        $this->trainingUserProgress = new ArrayCollection();
    }

    /**
     * @param mixed $content
     */
    public function setContent ($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent ()
    {
        return $this->content;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt ($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt ()
    {
        return $this->createdAt;
    }

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
     * @param mixed $isPublished
     */
    public function setIsPublished ($isPublished = false)
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getIsPublished ()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $publishEnd
     */
    public function setPublishEnd ($publishEnd)
    {
        $this->publishEnd = $publishEnd;
    }

    /**
     * @return mixed
     */
    public function getPublishEnd ()
    {
        return $this->publishEnd;
    }

    /**
     * @param mixed $publishStart
     */
    public function setPublishStart ($publishStart)
    {
        $this->publishStart = $publishStart;
    }

    /**
     * @return mixed
     */
    public function getPublishStart ()
    {
        return $this->publishStart;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug ($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getSlug ()
    {
        return $this->slug;
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
     * @param mixed $updatedAt
     */
    public function setUpdatedAt ($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt ()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setTrainingHasTutorials($trainingHasTutorials)
    {
        $this->trainingHasTutorials = new ArrayCollection();

        foreach ($trainingHasTutorials as $trainingHasTutorial) {
            $this->addTrainingHasTutorials($trainingHasTutorial);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTrainingHasTutorials()
    {
        return $this->trainingHasTutorials;
    }

    /**
     * {@inheritdoc}
     */
    public function addTrainingHasTutorials(TrainingHasTutorialInterface $trainingHasTutorial)
    {
        $trainingHasTutorial->setTraining($this);
        $this->trainingHasTutorials[] = $trainingHasTutorial;
    }

    /**
     * {@inheritdoc}
     */
    public function removeTrainingHasTutorials(TrainingHasTutorialInterface $trainingHasTutorial)
    {
        $this->trainingHasTutorials->removeElement($trainingHasTutorial);
    }

    /**
     * {@inheritdoc}
     */
    public function setUserHasTrainings($userHasTrainings)
    {
        $this->userHasTrainings = new ArrayCollection();

        if($userHasTrainings) {
            foreach ($userHasTrainings as $userHasTraining) {
                $this->addUserHasTraining($userHasTraining);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getUserHasTrainings()
    {
        return $this->userHasTrainings;
    }

    /**
     * {@inheritdoc}
     */
    public function addUserHasTraining(UserHasTrainingInterface $userHasTraining)
    {
        $userHasTraining->setTraining($this);
        $this->userHasTrainings[] = $userHasTraining;
    }

    /**
     * {@inheritdoc}
     */
    public function removeUserHasTraining(UserHasTrainingInterface $userHasTraining)
    {
        $this->userHasTrainings->removeElement($userHasTraining);
    }

    /**
     * {@inheritdoc}
     */
    public function setTrainingUserProgress($trainingUserProgress)
    {
        $this->trainingUserProgress = new ArrayCollection();

        if($trainingUserProgress) {
            foreach ($trainingUserProgress as $tup) {
                $this->addTrainingUserProgress($tup);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTrainingUserProgress()
    {
        return $this->trainingUserProgress;
    }

    /**
     * {@inheritdoc}
     */
    public function addTrainingUserProgress(TrainingUserProgressInterface $trainingUserProgress)
    {
        $trainingUserProgress->setTraining($this);
        $this->trainingUserProgress[] = $trainingUserProgress;
    }

    /**
     * {@inheritdoc}
     */
    public function removeTrainingUserProgress(TrainingUserProgressInterface $trainingUserProgress)
    {
        $this->trainingUserProgress->removeElement($trainingUserProgress);
    }
}
