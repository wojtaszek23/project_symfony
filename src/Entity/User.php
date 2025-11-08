<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nick = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 25)]
    private ?string $first_name = null;

    #[ORM\Column(length: 50)]
    private ?string $last_name = null;

    #[ORM\Column]
    private ?\DateTime $joining_time = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $logged_in_chat = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $last_activity_time_in_chat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(string $nick): static
    {
        $this->nick = $nick;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getJoiningTime(): ?\DateTime
    {
        return $this->joining_time;
    }

    public function setJoiningTime(\DateTime $joining_time): static
    {
        $this->joining_time = $joining_time;

        return $this;
    }

    public function getLoggedInChat(): ?bool
    {
        return $this->logged_in_chat;
    }

    public function setLoggedInChat(bool $logged_in_chat): static
    {
        $this->logged_in_chat = $logged_in_chat;

        return $this;
    }

    public function getLastActivityTimeInChat(): ?\DateTime
    {
        return $this->last_activity_time_in_chat;
    }

    public function setLastActivityTimeInChat(\DateTime $last_activity_time_in_chat): static
    {
        $this->last_activity_time_in_chat = $last_activity_time_in_chat;

        return $this;
    }
}
