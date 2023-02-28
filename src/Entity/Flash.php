<?php

namespace App\Entity;

use App\Repository\FlashRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: FlashRepository::class)]
class Flash
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['flashs:read','media:read','tatoueurs:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['flashs:read','tatoueurs:read'])]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['flashs:read','tatoueurs:read'])]
    private ?int $size = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['flashs:read'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['flashs:read'])]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    #[Groups(['flashs:read'])]
    #[Gedmo\Timestampable(on: 'update')]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'flash', targetEntity: Media::class)]
    #[Groups(['flashs:read'])]
    private Collection $media;

    #[ORM\ManyToOne(inversedBy: 'flashs')]
    #[Groups(['flashs:read'])]
    private ?Tatoueurs $tatoueur = null;

    public function __construct()
    {
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

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
            $medium->setFlash($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getFlash() === $this) {
                $medium->setFlash(null);
            }
        }

        return $this;
    }

    public function getTatoueur(): ?Tatoueurs
    {
        return $this->tatoueur;
    }

    public function setTatoueur(?Tatoueurs $tatoueur): self
    {
        $this->tatoueur = $tatoueur;

        return $this;
    }
}
