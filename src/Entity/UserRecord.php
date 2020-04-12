<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRecordRepository")
 */
class UserRecord
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recording", inversedBy="record_user")
     * @ORM\JoinColumn(name="record_id",referencedColumnName="id",onDelete="CASCADE",nullable=false)
     */
    private $record;

    
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="user_record")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id",onDelete="CASCADE",nullable=false)
     */
    private $user;

    

    public function getId(): ?int
    {
        return $this->id;
    }
}
