<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $durationHours = null;

    #[ORM\Column(length: 50)]
    private ?string $level = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'courses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trainer $trainer = null;

    /**
     * @var Collection<int, Enrollment>
     */
    #[ORM\OneToMany(targetEntity: Enrollment::class, mappedBy: 'course', cascade:['remove'])]
    private Collection $enrollements;

    public function __construct()
    {
        $this->enrollements = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDurationHours(): ?int
    {
        return $this->durationHours;
    }

    public function setDurationHours(int $durationHours): static
    {
        $this->durationHours = $durationHours;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTrainer(): ?Trainer
    {
        return $this->trainer;
    }

    public function setTrainer(?Trainer $trainer): static
    {
        $this->trainer = $trainer;

        return $this;
    }

    /**
     * @return Collection<int, Enrollment>
     */
    public function getEnrollements(): Collection
    {
        return $this->enrollements;
    }

    public function addEnrollement(Enrollment $enrollement): static
    {
        if (!$this->enrollements->contains($enrollement)) {
            $this->enrollements->add($enrollement);
            $enrollement->setCourse($this);
        }

        return $this;
    }

    public function removeEnrollement(Enrollment $enrollement): static
    {
        if ($this->enrollements->removeElement($enrollement)) {
            // set the owning side to null (unless already changed)
            if ($enrollement->getCourse() === $this) {
                $enrollement->setCourse(null);
            }
        }

        return $this;
    }

    public function __toString() : string
    {
        return $this->getTitle();
    }
}
