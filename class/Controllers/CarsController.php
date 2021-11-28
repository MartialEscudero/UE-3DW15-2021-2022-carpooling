<?php

namespace App\Controllers;

use App\Services\CarsService;

class CarsController
{
    /**
     * Return the html for the read action.
     */
    public function getCars(): string
    {
        $html = '';

        // Get all cars :
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html :
        foreach ($cars as $car) {
            $html .=
                '#' . $car->getId() . ' ' .
                $car->getBrand() . ' ' .
                $car->getModel() . ' ' .
                $car->getColor() . ' ' .
                $car->getNbrSlots() . ' ' . '<br />';
        }

        return $html;
    }

    /**
     * Return the html for the create action.
     */
    public function createCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['nbrSlots'])) {
            // Create the car :
            $carsService = new CarsService();
            $carId = $carsService->setCar(
                null,
                $_POST['brand'],
                $_POST['model'],
                $_POST['color'],
                $_POST['nbrSlots']
            );

            $isOk = true;
            
            if ($carId && $isOk) {
                $html = 'Véhicule ajouté avec succès.';
            } else {
                $html = 'Erreur lors de l\'ajout de véhicule.';
            }
        }

        return $html;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the car :
            $carsService = new CarsService();
            $isOk = $carsService->deleteCar($_POST['id']);
            if ($isOk) {
                $html = 'Véhicule supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression du véhicule.';
            }
        }

        return $html;
    }

    /**
     * Update a car.
     */
    public function updateCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['nbrSlots'])) {
            // Update the car :
            $carsService = new CarsService();
            $isOk = $carsService->setCar(
                $_POST['id'],
                $_POST['brand'],
                $_POST['model'],
                $_POST['color'],
                $_POST['nbrSlots']
            );
            if ($isOk) {
                $html = 'Véhicule mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour du véhicule.';
            }
        }

        return $html;
    }
}
