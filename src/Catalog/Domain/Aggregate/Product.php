<?php

declare(strict_types=1);

namespace App\Catalog\Domain\Aggregate;

class Product
{
    private ?int $id = null;

    public function __construct(
        private int     $externalId,
        private string  $title,
        private string  $description,
        private float   $price,
        private string  $category,
        private string  $thumbnail,
        private ?string $brand = null,
        private ?float  $rating = null,
        private ?int    $stock = null,
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getExternalId(): int { return $this->externalId; }
    public function getTitle(): string { return $this->title; }
    public function getDescription(): string { return $this->description; }
    public function getPrice(): float { return $this->price; }
    public function getCategory(): string { return $this->category; }
    public function getThumbnail(): string { return $this->thumbnail; }
    public function getBrand(): ?string { return $this->brand; }
    public function getRating(): ?float { return $this->rating; }
    public function getStock(): ?int { return $this->stock; }
}