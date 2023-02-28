<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['media:read','flashs:read','salons:read','tatoueurs:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['media:read','flashs:read','salons:read','tatoueurs:read'])]
    private ?string $fileName = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    #[Groups(['media:read'])]
    private ?Salon $salon = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    #[Groups(['media:read'])]
    private ?Flash $flash = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

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

    public function getFlash(): ?Flash
    {
        return $this->flash;
    }

    public function setFlash(?Flash $flash): self
    {
        $this->flash = $flash;

        return $this;
    }
}
