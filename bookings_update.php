<?php

use App\Controllers\BookingsController;
use App\Services\AdsService;
use App\Services\UsersService;

require __DIR__ . '/vendor/autoload.php';

$controller = new BookingsController();
echo $controller->updateBooking();

$adsService = new AdsService();
$ads = $adsService->getAds();

$usersService = new UsersService();
$users = $usersService->getUsers();
?>

<p>Mise à jour d'une réservation</p>
<form method="post" action="bookings_update.php" name="bookingUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id_booking">
    <br />
    <label for="dayStart">Choisir une date au format dd-mm-yyyy :</label>
    <input type="text" name="dayStart">
    <br />
    <label for="ad">Séléctionner une annonce :</label>
    <br />
    <?php foreach ($ads as $ad): ?>
    <input type="radio" name="ad_id"
        value="<?php echo $ad->getId(); ?>">
    <?php echo "Covoiturage de " . $ad->getPlaceStart() . " vers " . $ad->getPlaceEnd() . " à " . $ad->getDate()->format('d/m/Y'); ?>
    <br />
    <?php endforeach; ?>
    <br />
    <label for="users">Covoitureur(s) :</label>
    <?php foreach ($users as $user): ?>
        <input type="checkbox" name="users[]" value="<?php echo $user->getId(); ?>"><?php echo $user->getFirstname() . ' ' . $user->getLastname(); ?>
        <br />
    <?php endforeach; ?>
    <input type="submit" value="Modifier">
</form>