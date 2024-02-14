<?php

namespace App\Entity;

use App\Repository\GamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GamesRepository::class)]
class Games
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $UpdatedAt = null;

    #[ORM\OneToMany(targetEntity: Scores::class, mappedBy: 'games')]
    private Collection $scores;

    #[ORM\OneToMany(targetEntity: Comments::class, mappedBy: 'commented')]
    private Collection $comments;

    public function __construct()
    {
        $this->scores = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $CreatedAt): static
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $UpdatedAt): static
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Scores>
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function addScore(Scores $score): static
    {
        if (!$this->scores->contains($score)) {
            $this->scores->add($score);
            $score->setGames($this);
        }

        return $this;
    }

    public function removeScore(Scores $score): static
    {
        if ($this->scores->removeElement($score)) {
            // set the owning side to null (unless already changed)
            if ($score->getGames() === $this) {
                $score->setGames(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setCommented($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCommented() === $this) {
                $comment->setCommented(null);
            }
        }

        return $this;
    }
}
