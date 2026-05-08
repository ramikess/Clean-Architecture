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
        private int     $price,
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
    public function getPrice(): int { return $this->price; }
    public function getCategory(): string { return $this->category; }
    public function getThumbnail(): string { return $this->thumbnail; }
    public function getBrand(): ?string { return $this->brand; }
    public function getRating(): ?float { return $this->rating; }
    public function getStock(): ?int { return $this->stock; }

    public function update(
        string  $title,
        string  $description,
        int   $price,
        string  $category,
        string  $thumbnail,
        ?string $brand = null,
        ?float  $rating = null,
        ?int    $stock = null,
    ): void {
        $this->title       = $title;
        $this->description = $description;
        $this->price       = $price;
        $this->category    = $category;
        $this->thumbnail   = $thumbnail;
        $this->brand       = $brand;
        $this->rating      = $rating;
        $this->stock       = $stock;
    }
}