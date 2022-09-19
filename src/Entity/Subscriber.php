<?php

namespace App\Entity;

use App\Repository\SubscriberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: SubscriberRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Subscriber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $isRgpd = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $validationToken = null;

    #[ORM\Column]
    private ?bool $isValid = null;

    #[ORM\ManyToMany(targetEntity: Rubric::class, mappedBy: 'subscribers')]
    private Collection $rubrics;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->rubrics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function isIsRgpd(): ?bool
    {
        return $this->isRgpd;
    }

    public function setIsRgpd(bool $isRgpd): self
    {
        $this->isRgpd = $isRgpd;

        return $this;
    }

    public function getValidationToken(): ?string
    {
        return $this->validationToken;
    }

    public function setValidationToken(?string $validationToken): self
    {
        $this->validationToken = $validationToken;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * @return Collection|Rubric[]
     */
    public function getRubrics(): Collection
    {
        return $this->rubrics;
    }

    public function addRubric(Rubric $rubric): self
    {
        if (!$this->rubrics->contains($rubric)) {
            $this->rubrics[] = $rubric;
        }

        return $this;
    }

    public function removeRubric(Rubric $rubric): self
    {
        $this->rubrics->removeElement($rubric);
        return $this;
    }
}
