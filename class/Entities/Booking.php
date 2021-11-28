<?php

namespace App\Entities;

use DateTime;

class Booking
{
    private $id;
    private $day_start;
    private $ad_id;
    private $ad;
    private $user_link;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getDayStart(): DateTime
    {
        return $this->dayStart;
    }

    public function setDayStart(DateTime $dayStart): self
    {
        $this->dayStart = $dayStart;

        return $this;
    }

    public function getIdAd(): string
    {
        return $this->id_ad;
    }

    public function setIdAd(string $id_ad): self
    {
        $this->id_ad = $id_ad;

        return $this;
    }

    public function getAd(): ?Ad
    {
        return $this->ad;
    }

    public function setAd(Ad $ad)
    {
        $this->ad = $ad;

        return $this;
    }

    public function getUserLink(): ?array
    {
        return $this->user_link;
    }

    public function setUserLink(array $user_link): self
    {
        $this->user_link = $user_link;

        return $this;
    }
}
