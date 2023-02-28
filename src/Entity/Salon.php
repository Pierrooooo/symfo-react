<?php

namespace App\Entity;

use App\Repository\SalonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: SalonRepository::class)]
class Salon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['tatoueurs:read', 'salons:read','media:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tatoueurs:read', 'salons:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tatoueurs:read', 'salons:read'])]
    private ?string $adress = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['tatoueurs:read', 'salons:read'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['salons:read'])]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    #[Groups(['salons:read'])]
    #[Gedmo\Timestampable(on: 'update')]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'salon', targetEntity: Tatoueurs::class)]
    #[Groups(['salons:read'])]
    private Collection $tatoueurs;

    #[ORM\OneToMany(mappedBy: 'salon', targetEntity: Media::class)]
    #[Groups(['salons:read'])]
    private Collection $media;

    public function __construct()
    {
        $this->tatoueurs = new ArrayCollection();
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, Tatoueurs>
     */
    public function getTatoueurs(): Collection
    {
        return $this->tatoueurs;
    }

    public function addTatoueur(Tatoueurs $tatoueur): self
    {
        if (!$this->tatoueurs->contains($tatoueur)) {
            $this->tatoueurs->add($tatoueur);
            $tatoueur->setSalonId($this);
        }

        return $this;
    }

    public function removeTatoueur(Tatoueurs $tatoueur): self
    {
        if ($this->tatoueurs->removeElement($tatoueur)) {
            // set the owning side to null (unless already changed)
            if ($tatoueur->getSalonId() === $this) {
                $tatoueur->setSalonId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
            $medium->setSalonId($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getSalonId() === $this) {
                $medium->setSalonId(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
