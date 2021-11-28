<?php

use App\Controllers\BookingsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new BookingsController();
echo $controller->getBookings();
