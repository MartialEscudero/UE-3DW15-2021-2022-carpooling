<?php

use App\Controllers\BookingsController;
use App\Services\AdsService;
use App\Services\UsersService;

require __DIR__ . '/vendor/autoload.php';

$controller = new BookingsController();
echo $controller->createBooking();

$adsService = new AdsService();
$ads = $adsService->getAds();

$usersService = new UsersService();
$users = $usersService->getUsers();
?>

<p>Réservation</p>
<form method="post" action="bookings_create.php" name="bookingCreateForm">
    <label for="ad">Séléctionne une annonce :</label>
    <br />
    <?php foreach ($ads as $ad): ?>
    <input type="radio" name="adId"
        value="<?php echo $ad->getId(); ?>">
    <?php echo "Covoiturage de " . $ad->getPlaceStart() . " vers " . $ad->getPlaceEnd() . " le " . $ad->getDate()->format('d/m/Y'); ?>
    <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Réserver">
</form>