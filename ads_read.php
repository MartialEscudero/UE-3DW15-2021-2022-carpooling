<?php

use App\Controllers\AdsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AdsController();
echo $controller->getAds();
