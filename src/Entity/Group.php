<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupRepository")
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */

    

    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="group")
     */
    private $task;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GroupUser", mappedBy="group")
     */
    private $group_user;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
