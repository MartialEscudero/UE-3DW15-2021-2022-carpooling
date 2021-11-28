<?php

namespace App\Controllers;

use App\Services\AdsService;

class AdsController
{
    /**
     * Return the html for the read action.
     */
    public function getAds(): string
    {
        $html = '';

        // Get all ads :
        $adsService = new AdsService();
        $ads = $adsService->getAds();

        // Get html :
        foreach ($ads as $ad) {
            $html .=
                '#' . $ad->getId() . ' ' .
                $ad->getPrice() . '€' . ' ' .
                $ad->getPlaceStart() . ' ' .
                $ad->getPlaceEnd() . ' ' .
                $ad->getDate()->format('d-m-Y') . ' ' .  '<br />';
        }

        return $html;
    }

    /**
     * Return the html for the create action.
     */
    public function createAd(): string
    {
        $html = '';

        // If the form have been submitted :
        if (// isset($_POST['id']) &&
            isset($_POST['price']) &&
            isset($_POST['placeStart']) &&
            isset($_POST['placeEnd']) &&
            isset($_POST['dateStart'])) {
            // Create the ad :
            $adsService = new AdsService();
            $adId = $adsService->setAd(
                null,
                $_POST['price'],
                $_POST['placeStart'],
                $_POST['placeEnd'],
                $_POST['dateStart']
            );

            $isOk = true;
            
            if ($adId && $isOk) {
                $html = 'Annonce ajoutée avec succès.';
            } else {
                $html = 'Erreur lors de l\'ajout de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Delete the ad.
     */
    public function deleteAd(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the ad :
            $adsService = new AdsService();
            $isOk = $adsService->deleteAd($_POST['id']);
            if ($isOk) {
                $html = 'Annonce supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Update the ad.
     */
    public function updateAd(): string
    {
        $html = '';

        // If the form have been submitted :
            if (//isset($_POST['id']) &&
            isset($_POST['price']) &&
            isset($_POST['placeStart']) &&
            isset($_POST['placeEnd']) &&
            isset($_POST['dateStart'])) {
                // Update the ad :
                $adsService = new AdsService();
                $isOk = $adsService->setAd(
                    $_POST['id'],
                    $_POST['price'],
                    $_POST['placeStart'],
                    $_POST['placeEnd'],
                    $_POST['dateStart']
                );
                if ($isOk) {
                    $html = 'Annonce mise à jour avec succès.';
                } else {
                    $html = 'Erreur lors de la mise à jour de l\'annonce.';
                }
            }

        return $html;
    }
}
