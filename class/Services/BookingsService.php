<?php

namespace App\Services;

use App\Entities\Booking;
use App\Entities\Ad;
use App\Entities\User;
use DateTime;

class BookingsService
{
    /**
     * Return all bookings from the database.
     */
    public function getBookings(): array
    {
        $bookings = [];

        $dataBaseService = new DataBaseService();
        $bookingsDTO = $dataBaseService->getBookings();
        if (!empty($bookingsDTO)) {
            foreach ($bookingsDTO as $bookingDTO) {
                $booking = new Booking();
                $booking->setId($bookingDTO['id_booking']);
                $booking->setIdAd($bookingDTO['ad_id']);
                $date = new DateTime($bookingDTO['start_day']);
                if ($date !== false) {
                    $booking->setDayStart($date);
                }

                // Set booking's ad
                $ad = $this->getAd($bookingDTO['ad_id']);
                $booking->setAd($ad);

                // Get users link to booking
                $user_link = $this->getBookings($bookingDTO['id_booking']);
                $booking->setUserLink($user_link);

                $bookings[] = $booking;
            }
        }

        return $bookings;
    }

    /**
     * Create or update a booking.
     */
    public function setBooking(?string $id, string $dayStart, string $adId, ?array $users): string
    {
        $bookingId = '';

        $dataBaseService = new DataBaseService();
        $start_day_DateTime = new DateTime($dayStart);

        if (empty($id)) {
            $bookingId = $dataBaseService->createBooking($start_day_DateTime, $adId);
        } else {
            $dataBaseService->updateBooking($id, $start_day_DateTime, $adId, $users);
            $bookingId = $id;
        }

        return $bookingId;
    }

    /**
     * Delete a booking.
     */
    public function deleteBooking(string $id): bool
    {
        $dataBaseService = new DataBaseService();

        return $dataBaseService->deleteBooking($id);
    }

    /**
     * Return a ad from a booking id.
     */
    public function getAd(string $id): Ad
    {
        $ad = new Ad();
        $dataBaseService = new DataBaseService();
        $adDTO = $dataBaseService->getAds($id);

        if (!empty($adDTO)) {
            $ad->setId($adDTO['id']);
            $ad->setPlaceStart($adDTO['placeStart']);
            $ad->setPlaceEnd($adDTO['placeEnd']);
        }
        //Get data of the ad's author
        $user = new User();
        $userDTO = $dataBaseService->getUser($adDTO['user_author_id']);

        if (!empty($userDTO)) {
            $user->setId($userDTO['id_user'])
                ->setFirstname($userDTO['firstname'])
                ->setLastname($userDTO['lastname'])
                ->setEmail($userDTO['email'])
                ;
            $date = new DateTime($userDTO['birthday']);
            if ($date !== false) {
                $user->setBirthday($date);
            }
        }

        return $ad;
    }

    /**
     * Create relation bewteen a booking and a user link.
     */
    public function setBookingUser(string $userId, string $bookingId): bool
    {
        $dataBaseService = new DataBaseService();

        return $dataBaseService->setBookingUser($userId, $bookingId);
    }

    /**
     * Get user link of booking id.
     */
    public function getBookingUserLink(string $id)
    {
        $bookingUser = [];

        $dataBaseService = new DataBaseService();

        // Get relation between carpooler and booking
        $bookingUserLinkDTO = $dataBaseService->getBookingUserLink($id);
        if (!empty($bookingUserLinkDTO)) {
            foreach ($bookingUserLinkDTO as $userDTO) {
                $user = new User();
                $user->setId($userDTO['id'])
                    ->setFirstname($userDTO['firstname'])
                    ->setLastname($userDTO['lastname'])
                    ->setEmail($userDTO['email'])
                ;
                $date = new DateTime($userDTO['birthday']);
                if ($date !== false) {
                    $user->setBirthday($date);
                }
                $bookingUser[] = $user;
            }
        }

        return $bookingUser;
    }
}
