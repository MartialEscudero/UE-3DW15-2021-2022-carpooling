<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->createCar();

?>

<p>Ajout d'un véhicule</p>
<form method="post" action="cars_create.php" name ="carsCreateForm">
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
    <input type="submit" value="Ajouter un véhicule">
</form>