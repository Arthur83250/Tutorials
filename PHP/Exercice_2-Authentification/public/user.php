<?php

require '../vendor/autoload.php';

use App\App;
App::getAuth()->requireRole('user', 'admin');

?>

Réservé aux user