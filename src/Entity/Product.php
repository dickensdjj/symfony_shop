<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
     private $created_at;

    /**
     * @ORM\Column(type="string")
     */
     private $sku;

    /**
     * @ORM\Column(type="boolean")
     */
     private $feature;

    /**
     * @ORM\Column(type="boolean")
     */
     private $hotsale;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getHotsale(): ?string
    {
        return $this->hotsale;
    }

    public function setHotsale(?string $hotsale): self
    {
        $this->hotsale = $hotsale;

        return $this;
    }

    public function getFeatured(): ?string
    {
        return $this->feature;
    }

    public function setFeatured(?string $feature): self
    {
        $this->feature = $feature;

        return $this;
    }
}
