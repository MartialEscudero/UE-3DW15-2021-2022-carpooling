<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->updateCar();
?>

<p>Mise à jour d'un véhicule</p>
<form method="post" action="cars_update.php" name ="carUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="brand">Marque :</label>
    <input type="text" name="brand">
    <br />
    <label for="model">Modèle :</label>
    <input type="text" name="model">
    <br />
    <label for="color">Couleur :</label>
    <input type="text" name="color">
    <br />
    <label for="nbrSlots">Nombre d'emplacement:</label>
    <input type="text" name="nbrSlots">
    <br />
    <input type="submit" value="Mettre à jour un véhicule">
</form>