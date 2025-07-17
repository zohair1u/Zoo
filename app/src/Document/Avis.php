<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
// use Doctrine\ODM\MongoDB\Mapping\Attributes as MongoDB;
#[MongoDB\Document]
class Avis
{
    #[MongoDB\Id]
    private?string $id = null;

    #[MongoDB\Field(type: 'string')]
    private?string $username = null;

    #[MongoDB\Field(type: 'int')]
    private?int $note = null;

    #[MongoDB\Field(type: 'string')]
    private?string $message = null;

    #[MongoDB\Field(type: 'date')]
    private \DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
}

    // Getters & Setters

    public function getId():?string
    {
        return $this->id;
}

    public function getUsername():?string
    {
        return $this->username;
}

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
}

    public function getNote():?int
    {
        return $this->note;
}

    public function setNote(int $note): self
    {
        $this->note = $note;
        return $this;
}

    public function getMessage():?string
    {
        return $this->message;
}

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
}

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
}
}
