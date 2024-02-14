<?php

namespace App\Entity;

use App\Repository\ScoresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoresRepository::class)]
class Scores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbPoints = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startGame = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endGame = null;

    #[ORM\ManyToOne(inversedBy: 'scores')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'scores')]
    private ?Games $games = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPoints(): ?int
    {
        return $this->nbPoints;
    }

    public function setNbPoints(?int $nbPoints): static
    {
        $this->nbPoints = $nbPoints;

        return $this;
    }

    public function getStartGame(): ?\DateTimeInterface
    {
        return $this->startGame;
    }

    public function setStartGame(?\DateTimeInterface $startGame): static
    {
        $this->startGame = $startGame;

        return $this;
    }

    public function getEndGame(): ?\DateTimeInterface
    {
        return $this->endGame;
    }

    public function setEndGame(?\DateTimeInterface $endGame): static
    {
        $this->endGame = $endGame;

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

    public function getGames(): ?Games
    {
        return $this->games;
    }

    public function setGames(?Games $games): static
    {
        $this->games = $games;

        return $this;
    }
}
