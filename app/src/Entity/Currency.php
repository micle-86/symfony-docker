<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CurrencyRepository::class)
 * @ORM\Table(name="Currency")
 */
class Currency
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=3)
   */
  private $name;

  /**
   * @ORM\Column(type="float")
   */
  private $rate;

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

  public function getRate(): ?float
  {
    return $this->rate;
  }

  public function setRate(float $rate): self
  {
    $this->rate = $rate;

    return $this;
  }

  public function ___toString(): string
  {
    return json_encode($this);
  }
}
