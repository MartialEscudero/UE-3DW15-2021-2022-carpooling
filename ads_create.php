<?php

use App\Controllers\AdsController;
use App\Controllers\UsersController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AdsController();
echo $controller->createAd();

$userController = new UsersController();
$users = $userController->getUsersSelect();
?>

<p>Ajout d'une annonce</p>
<form method="post" action="ads_create.php" name ="adCreateForm">
    <label for="user_id">Utilisateur :</label>
    <select name="user_id" id="user_id">
    <!-- Retourne l'id de l'utilisateur dans la value qui va permettre de faire le lien Utilisateur - Annonce -->
    <?php foreach ($users as $user) { ?>
        <option value="<?php echo($user[1]); ?>"><?php echo($user[0]); ?></option>
    <?php } ?>
    </select>
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
    <input type="submit" value="Ajouter une annonce">
</form>