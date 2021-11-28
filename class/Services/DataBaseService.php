<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = 'password';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): string
    {
        $userId = '';

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $userId = $this->connection->lastInsertId();
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }

    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN users_cars as uc ON uc.car_id = c.id
            WHERE uc.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userCars = $results;
        }

        return $userCars;
    }

    /**
     * Create a car.
     */
    public function createCar(string $brand, string $model, string $color, string $nbrSlots): string
    {
        $carId = '';

        $data = [
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'nbrSlots' => $nbrSlots,
        ];
        $sql = 'INSERT INTO cars (brand, model, color, nbrSlots) VALUES (:brand, :model, :color, :nbrSlots)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $carId = $this->connection->lastInsertId();
        }

        return $carId;
    }

    /**
     * Update a car.
     */
    public function updateCar(string $id, string $brand, string $model, string $color, string $nbrSlots): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'nbrSlots' => $nbrSlots,
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, color = :color, nbrSlots = :nbrSlots WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM cars WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all ads.
     */
    public function getAds(): array
    {
        $ads = [];

        $sql = 'SELECT * FROM ads';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $ads = $results;
        }

        return $ads;
    }

    /**
     * Create a ad.
     */
    public function createAd(string $price, string $placeStart, string $placeEnd, Datetime $dateStart): string
    {
        $adId = '';

        $data = [
            'price' => $price,
            'placeStart' => $placeStart,
            'placeEnd' => $placeEnd,
            'dateStart' => $dateStart->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO ads (price, placeStart, placeEnd, dateStart) VALUES (:price, :placeStart, :placeEnd, :dateStart)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $adId = $this->connection->lastInsertId();
        }

        return $adId;
    }

    /**
     * Update a ad.
     */
    public function updateAd(string $id, string $price, string $placeStart, string $placeEnd, Datetime $dateStart): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'price' => $price,
            'placeStart' => $placeStart,
            'placeEnd' => $placeEnd,
            'dateStart' => $dateStart->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE ads SET price = :price, placeStart = :placeStart, placeEnd = :placeEnd, dateStart = :dateStart WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return a user from its id.
     */
    public function getUser(string $id): array
    {
        $user = [];
        $data = [
            'id' => $id,
        ];

        $sql = 'SELECT * FROM users WHERE users.id = :id';
        $query = $this->connection->prepare($sql);
        $query->execute($data);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $user = $result;
        }

        return $user;
    }

    /**
     * Delete the ad.
     */
    public function deleteAd(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM ads WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all bookings.
     */
    public function getBookings(): array
    {
        $bookings = [];

        $sql = 'SELECT * FROM bookings';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $bookings = $results;
        }

        return $bookings;
    }

    /**
     * Create booking.
     */
    public function createBooking(DateTime $start_day, string $ad_id): string
    {
        $bookingId = '';

        $data = [
            'start_day' => $start_day->format(DateTime::RFC3339),
            'ad_id' => $ad_id,
        ];
        $sql = 'INSERT INTO bookings (start_day, ad_id) VALUES (:start_day, :ad_id)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $bookingId = $this->connection->lastInsertId();
        }

        return $bookingId;
    }

    /**
     * Update booking.
     */
    public function updateBooking(string $id, DateTime $start_day, string $ad_id, array $users): bool
    {
        $isOk1 = false;
        $isOk2 = false;

        //update the booking
        $data = [
            'id_booking' => $id,
            'start_day' => $start_day->format(DateTime::RFC3339),
            'ad_id' => $ad_id,
        ];
        $sql = 'UPDATE bookings SET start_day = :start_day, ad_id = :ad_id WHERE id_booking = :id_booking;';
        $query = $this->connection->prepare($sql);
        $isOk1 = $query->execute($data);

        //delete booking users relation
        $data = [
            'id_booking' => $id,
        ];
        $sql = 'DELETE FROM users_bookings WHERE booking_id = :id_booking;';
        $query = $this->connection->prepare($sql);
        $isOk2 = $query->execute($data);

        //update booking users relation
        foreach ($users as $user) {
            //if error
            if (!($this->setBookingUser($user, $id))) {
                return false;
            }
        }

        if ($isOk1 == $isOk2) {
            return true;
        }

        return false;
    }

    /**
      * Delete a booking.
      */
    public function deleteBooking(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM bookings WHERE id_booking = :id; DELETE FROM users_bookings WHERE booking_id = :id;';
        $query = $this->connection->prepare($sql);

        return $query->execute($data);
    }

    /**
     * Create relation bewteen a booking and its user link.
     */
    public function setBookingUser(string $userId, string $bookingId): bool
    {
        $data = [
            'userId' => $userId,
            'bookingId' => $bookingId,
        ];

        $sql = 'INSERT INTO users_bookings (booking_id, user_id) VALUES (:bookingId, :userId)';
        $query = $this->connection->prepare($sql);

        return $query->execute($data);
    }

    /**
     * Get carpooler of booking id.
     */
    public function getBookingUserLink(string $bookingId): array
    {
        $bookingUserLink = [];

        $data = [
            'booking_id' => $bookingId,
        ];
        $sql = '
            SELECT u.*
            FROM users as u
            LEFT JOIN users_bookings as ub ON ub.user_id = u.id_user
            WHERE ub.booking_id = :booking_id';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $bookingUser = $results;
        }

        return $bookingUser;
    }
}
