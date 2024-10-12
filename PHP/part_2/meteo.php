<?php

require_once '../vendor/autoload.php';

$weather = new App\OpenWeather('a0e40d5b022ccad39467ec4678386fba');
$error = null;
try{
    $forecast = $weather->getForecast('Montpellier,fr');
    $today = $weather->getToday('Montpellier,fr');
}catch (Exception | Error $e) {
   $error = $e->getMessage();
}
require 'elements/header.php';
?>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php else: ?>
    <div class="container">
        <ul>
            <li>En ce moment <?= $today['date']->format('d/m/Y') ?> <?= $today['description'] ?> <?= $today['temp'] ?><li>
            <?php foreach($forecast as $day): ?>
            <li><?= $day['date']->format('d/m/Y') ?> <?= $day['description'] ?> <?= $day['temp'] ?><li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<?php

use App\OpenWeather;
require 'elements/footer.php';


//https://api.openweathermap.org/data/2.5/weather?q=Montpellier,fr&appid=a0e40d5b022ccad39467ec4678386fba&units=metric&lang=fr

?>