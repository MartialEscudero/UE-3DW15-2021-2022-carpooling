<?php

namespace App\Controllers;

use App\Services\BookingsService;

class BookingsController
{
    /**
     * Return the html for the create action.
     */
    public function createBooking(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['dayStart'])
            && isset($_POST['ad_id'])
            && isset($_POST['users'])) {
            // Create the booking :
            $bookingService = new BookingsService();
            $bookingId = $bookingService->setBooking(
                null,
                $_POST['dayStart'],
                $_POST['ad_id'],
                null
            );

            // Booking and users relations :
            $isOk = true;
            if (!empty($_POST['users'])) {
                foreach ($_POST['users'] as $userId) {
                    $isOk = $bookingService->setBookingUser($userId, $bookingId);
                }
            }

            if ($bookingId && $isOk) {
                $html = 'Réservation réalisée avec succès.';
            } else {
                $html = 'Erreur lors de la réservation.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getBookings(): string
    {
        $html = '';

        // Get all bookings :
        $bookingsService = new BookingsService();
        $bookings = $bookingsService->getBookings();

        // Get html :
        foreach ($bookings as $booking) {
            $html = '';
            if (!empty($booking->getAd())) {
                $ad = $booking->getAd();
                $html .= $ad->getId() .
                ' Lieu de départ : ' . $ad->getPlaceStart() .
                " Lieu d'arrivée : " . $ad->getPlaceEnd();
            }
            
            $html .=
                '#' . $booking->getId() . ' ' .
                $booking->getDayStart()->format('d-m-Y') . ' ' .
                $html .
                '<br />';
        }

        return $html;
    }

    /**
     * Update the booking.
     */
    public function updateBooking(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id_booking'])
            && isset($_POST['dayStart'])
            && isset($_POST['ad_id'])
            && isset($_POST['users'])) {
            // Update the booking :
            $BookingsService = new BookingsService();
            $isOk = $BookingsService->setBooking(
                $_POST['id_booking'],
                $_POST['dayStart'],
                $_POST['ad_id'],
                $_POST['users']
            );
            if ($isOk) {
                $html = 'Réservation mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la réservation.';
            }
        }

        return $html;
    }

    /**
     * Delete a booking.
     */
    public function deleteBooking(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the user :
            $usersService = new BookingsService();
            $isOk = $usersService->deleteBooking($_POST['id']);
            if ($isOk) {
                $html = 'Réservation supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la réservation.';
            }
        }

        return $html;
    }
}
