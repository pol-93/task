<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecordingRepository")
 */
class Recording
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateRecording;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Beforepicture;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $pictureAfter;

    /**
     * @ORM\Column(type="integer")
     */
    private $confirmed;

    /**
     * @ORM\Column(type="integer")
     */
    
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Task", inversedBy="record")
     * @ORM\JoinColumn(name="task_id",referencedColumnName="id",onDelete="CASCADE",nullable=false)
     */
    private $task;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserRecord", mappedBy="record")
     */
    private $record_user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRecording(): ?\DateTimeInterface
    {
        return $this->dateRecording;
    }

    public function setDateRecording(\DateTimeInterface $dateRecording): self
    {
        $this->dateRecording = $dateRecording;

        return $this;
    }

    public function getBeforepicture(): ?string
    {
        return $this->Beforepicture;
    }

    public function setBeforepicture(?string $Beforepicture): self
    {
        $this->Beforepicture = $Beforepicture;

        return $this;
    }

    public function getPictureAfter(): ?string
    {
        return $this->pictureAfter;
    }

    public function setPictureAfter(?string $pictureAfter): self
    {
        $this->pictureAfter = $pictureAfter;

        return $this;
    }

    public function getConfirmed(): ?int
    {
        return $this->confirmed;
    }

    public function setConfirmed(int $confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    public function getTASkID(): ?int
    {
        return $this->TASk_ID;
    }

    public function setTASkID(int $TASk_ID): self
    {
        $this->TASk_ID = $TASk_ID;

        return $this;
    }
}
