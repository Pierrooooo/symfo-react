<?php

namespace App\Entity;

use App\Repository\TatoueursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: TatoueursRepository::class)]
class Tatoueurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['tatoueurs:read', 'salons:read','media:read','flashs:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tatoueurs:read', 'salons:read'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tatoueurs:read', 'salons:read'])]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tatoueurs:read'])]
    private ?string $instagram = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tatoueurs:read'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tatoueurs:read'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['tatoueurs:read'])]
    private ?string $image_url = null;

    #[ORM\ManyToOne(inversedBy: 'tatoueurs')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['tatoueurs:read'])]
    private ?Salon $salon = null;

    #[ORM\Column]
    #[Groups(['tatoueurs:read'])]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    #[Groups(['tatoueurs:read'])]
    #[Gedmo\Timestampable(on: 'update')]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'tatoueur', targetEntity: Flash::class)]
    #[Groups(['tatoueurs:read'])]
    private Collection $flashs;

    #[ORM\ManyToMany(targetEntity: Color::class, inversedBy: 'tatoueurs')]
    #[Groups(['tatoueurs:read'])]
    private Collection $colors;

    #[ORM\Column(nullable: true)]
    #[Groups(['tatoueurs:read'])]
    private ?bool $allColors = null;

    public function __construct()
    {
        $this->flashs = new ArrayCollection();
        $this->colors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function getSalonId(): ?Salon
    {
        return $this->salon;
    }

    public function setSalonId(?Salon $salon): self
    {
        $this->salon = $salon;

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
     * @return Collection<int, Flash>
     */
    public function getflashs(): Collection
    {
        return $this->flashs;
    }

    public function addFlash(Flash $flash): self
    {
        if (!$this->flashs->contains($flash)) {
            $this->flashs->add($flash);
            $flash->setTatoueur($this);
        }

        return $this;
    }

    public function removeFlash(Flash $flash): self
    {
        if ($this->flashs->removeElement($flash)) {
            // set the owning side to null (unless already changed)
            if ($flash->getTatoueur() === $this) {
                $flash->setTatoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Color>
     */
    public function getColors(): Collection
    {
        return $this->colors;
    }

    public function addColor(Color $color): self
    {
        if (!$this->colors->contains($color)) {
            $this->colors->add($color);
        }

        return $this;
    }

    public function removeColor(Color $color): self
    {
        $this->colors->removeElement($color);

        return $this;
    }

    public function isAllColors(): ?bool
    {
        return $this->allColors;
    }

    public function setAllColors(?bool $allColors): self
    {
        $this->allColors = $allColors;

        return $this;
    }
}
