<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $message = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Group::class, inversedBy: 'messages')]
    #[ORM\JoinTable(name: "group_message")]
    private Collection $messageToGroups;

    public function __construct()
    {
        $this->messageToGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getMessageToGroups(): Collection
    {
        return $this->messageToGroups;
    }

    public function addMessageToGroup(Group $messageToGroup): self
    {
        if (!$this->messageToGroups->contains($messageToGroup)) {
            $this->messageToGroups->add($messageToGroup);
        }

        return $this;
    }

    public function removeMessageToGroup(Group $messageToGroup): self
    {
        $this->messageToGroups->removeElement($messageToGroup);

        return $this;
    }
}
