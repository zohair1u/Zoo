<?php

namespace App\Entity;

use App\Repository\SoinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SoinRepository::class)]
class Soin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $soin = null;

    #[ORM\Column]
    private ?\DateTime $dateSoin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaires = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private?\DateTime $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'soins')]
    private ?Animal $animal = null;

    #[ORM\ManyToOne(inversedBy: 'soins')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSoin(): ?string
    {
        return $this->soin;
    }

    public function setSoin(string $soin): static
    {
        $this->soin = $soin;

        return $this;
    }

    public function getDateSoin(): ?\DateTime
    {
        return $this->dateSoin;
    }

    public function setDateSoin(\DateTime $dateSoin): static
    {
        $this->dateSoin = $dateSoin;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): static
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
