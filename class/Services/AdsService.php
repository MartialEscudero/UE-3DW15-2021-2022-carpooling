<?php

namespace App\Services;

use App\Entities\Ad;
use App\Entities\User;
use App\Entities\Booking;
use DateTime;

class AdsService
{
    /**
     * Return all cars.
     */
    public function getAds(): array
    {
        $ads = [];

        $dataBaseService = new DataBaseService();
        $adsDTO = $dataBaseService->getAds();
        if (!empty($adsDTO)) {
            foreach ($adsDTO as $adDTO) {
                $ad = new Ad();
                $ad->setId($adDTO['id']);
                $ad->setPrice($adDTO['price']);
                $ad->setPlaceStart($adDTO['placeStart']);
                $ad->setPlaceEnd($adDTO['placeEnd']);
                $dateStart = new DateTime($adDTO['dateStart']);
                if ($dateStart !== false) {
                    $ad->setDate($dateStart);
                }
                $ads[] = $ad;
            }
        }

        return $ads;
    }

    /**
     * Create or update a ad.
     */
    public function setAd(?string $id, string $price, string $placeStart, string $placeEnd, string $dateStart): string
    {
        $adId = '';

        $dataBaseService = new DataBaseService();
        $dateStartDateTime = new DateTime($dateStart);

        if (empty($id)) {
            $adId = $dataBaseService->createAd($price, $placeStart, $placeEnd, $dateStartDateTime);
        } else {
            $dataBaseService->updateAd($id, $price, $placeStart, $placeEnd, $dateStartDateTime);
            $adId = $id;
        }

        return $adId;
    }

    /**
     * Delete a ad.
     */
    public function deleteAd(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAd($id);

        return $isOk;
    }

    /**
     * Return all booking from ad.
     */
    public function getBookings(string $id): array
    {
        return [];
    }

    /**
     * Return author of ad.
     */
    public function getUserId(string $userId): User
    {
        $user = new User();
        $dataBaseService = new DataBaseService();
        $userDTO = $dataBaseService->getUser($userId);

        if (!empty($userDTO)) {
            $user->setId($userDTO['id']);
            $user->setFirstname($userDTO['firstname']);
            $user->setLastname($userDTO['lastname']);
            $user->setEmail($userDTO['email']);
            $date = new DateTime($userDTO['birthday']);
            if ($date !== false) {
                $user->setBirthday($date);
            }
        }

        return $user;
    }
}
