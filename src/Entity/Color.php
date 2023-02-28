<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: ColorRepository::class)]
class Color
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['color:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['color:read'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['color:read'])]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    #[Groups(['color:read'])]
    #[Gedmo\Timestampable(on: 'update')]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToMany(targetEntity: Tatoueurs::class, mappedBy: 'colors')]
    private Collection $tatoueurs;

    public function __construct()
    {
        $this->tatoueurs = new ArrayCollection();
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
            $tatoueur->addColor($this);
        }

        return $this;
    }

    public function removeTatoueur(Tatoueurs $tatoueur): self
    {
        if ($this->tatoueurs->removeElement($tatoueur)) {
            $tatoueur->removeColor($this);
        }

        return $this;
    }
}
