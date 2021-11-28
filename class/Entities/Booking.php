<?php

namespace App\Entities;

use DateTime;

class Booking
{
    private $id;
    private $start_day;
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

    public function getStartDay(): DateTime
    {
        return $this->start_day;
    }

    public function setStartDay(DateTime $start_day): self
    {
        $this->start_day = $start_day;

        return $this;
    }

    public function getIdAd(): string
    {
        return $this->ad_id;
    }

    public function setIdAd(string $ad_id): self
    {
        $this->ad_id = $ad_id;

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
