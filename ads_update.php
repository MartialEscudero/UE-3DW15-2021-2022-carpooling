<?php

use App\Controllers\AdsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AdsController();
echo $controller->updateAd();
?>

<p>Mise à jour d'une annonce</p>
<form method="post" action="ads_update.php" name ="adUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="price">Prix :</label>
    <input type="text" name="price">
    <br />
    <label for="placeStart">Lieu de départ :</label>
    <input type="text" name="placeStart">
    <br />
    <label for="placeEnd">Lieu d'arrivé :</label>
    <input type="text" name="placeEnd">
    <br />
    <label for="dateStart">Date dd-mm-yyyy :</label>
    <input type="text" name="dateStart">
    <br />
    <input type="submit" value="Mettre à jour l'annonce">
</form>