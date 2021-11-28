<?php

namespace App\Entities;

use DateTime;

class Ad
{
    private $id;
    private $price;
    private $placeStart;
    private $placeEnd;
    private $date;
    private $ads;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPlaceStart(): string
    {
        return $this->placeStart;
    }

    public function setPlaceStart(string $placeStart): self
    {
        $this->placeStart = $placeStart;

        return $this;
    }

    public function getPlaceEnd(): string
    {
        return $this->placeEnd;
    }

    public function setPlaceEnd(string $placeEnd): self
    {
        $this->placeEnd = $placeEnd;

        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getAds(): ?array
    {
        return $this->ads;
    }

    public function setAds(array $ads)
    {
        $this->ads = $ads;

        return $this;
    }
}
