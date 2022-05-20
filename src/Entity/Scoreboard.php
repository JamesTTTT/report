<?php

namespace App\Entity;

use App\Repository\ScoreboardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreboardRepository::class)]
class Scoreboard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'float')]
    private $score;

    #[ORM\Column(type: 'integer')]
    private $diamonds;

    #[ORM\Column(type: 'float')]
    private $time;

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

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function setScore(float $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getDiamonds(): ?int
    {
        return $this->diamonds;
    }

    public function setDiamonds(int $diamonds): self
    {
        $this->diamonds = $diamonds;

        return $this;
    }

    public function getTime(): ?float
    {
        return $this->time;
    }

    public function setTime(float $time): self
    {
        $this->time = $time;

        return $this;
    }
}
