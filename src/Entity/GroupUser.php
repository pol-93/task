<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupUserRepository")
 */
class GroupUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="user_group")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id",onDelete="CASCADE",nullable=false)
     */
    private $user;

    
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\group", inversedBy="group_user")
     * @ORM\JoinColumn(name="group_id",referencedColumnName="id",onDelete="CASCADE",nullable=false)
     */
    private $group;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUSERID(): ?int
    {
        return $this->USER_ID;
    }

    public function setUSERID(int $USER_ID): self
    {
        $this->USER_ID = $USER_ID;

        return $this;
    }

    public function getGROUPID(): ?int
    {
        return $this->GROUP_ID;
    }

    public function setGROUPID(int $GROUP_ID): self
    {
        $this->GROUP_ID = $GROUP_ID;

        return $this;
    }
}
