<?php

//Checkbox
$parfums =[
    'Fraise' => 4,
    'Chocolat' => 5,
    'Vanille' => 3
];

// Radio
$cornets = [
    'Pot' => 2,
    'Cornet' => 3
];

//Checkbox
$supplements = [
    'Pépites de chocolat' => 1,
    'Chantilly' => 0.5
];

require_once 'functions.php';

$ingredients = [];
$coutTotal = 0;
$title = "Composer votre glace";

foreach (['parfum', 'supplement', 'cornet'] as $name){
    if (isset($_GET[$name])){
        $liste = $name . 's';
        $choix = $_GET[$name];
        if (is_array($choix)) {
            foreach($choix as $value) {
                if(isset($$liste[$value])){
                    $ingredients[] = $value;
                    $coutTotal += $$liste[$value];
                }
            }
        }else{
            if(isset($$liste[$choix]));{
            $ingredients[] = $choix;
            $coutTotal += $$liste[$value];
            }
        }
    }
}

if (isset($_GET['cornet'])){
    $cornet = $_GET['cornet'];
}

require 'header.php';
?>

<br>

<div class="container">

<H3>VOTRE GLACE</H3>
<form action="/jeu.php" method="GET" >

    <h4>Parfums</h4>
    <?php foreach($parfums as $parfum => $prix): ?>
    <div class="checkbox">
        <label>        
            <?= checkbox('parfum', $parfum, $_GET) ?>
            <?= $parfum ?> - <?= $prix ?> €
        </label>        
    </div>
    <?php endforeach; ?>
    
    <br>
    
    <h4>Cornets</h4>
    <?php foreach($cornets as $cornet => $prix): ?>
    <div class="checkbox">
        <label>        
            <?= radio('cornet', $cornet, $_GET) ?>
            <?= $cornet ?> - <?= $prix ?> €
        </label>        
    </div>
    <?php endforeach; ?>

    <br>
    
    <h4>Suppléments</h4>
    <?php foreach($supplements as $supplement => $prix): ?>
    <div class="checkbox">
        <label>        
            <?= checkbox('supplement', $supplement, $_GET) ?>
            <?= $supplement ?> - <?= $prix ?> €
        </label>        
    </div>
    <?php endforeach; ?>

    <br>
 
    <button class="btn btn-primary" type="submit">Voir le prix</button>
    <div>
        <ul>
            <?php foreach($ingredients as $ingredient): ?>
            <li><?= $ingredient ?></li>
            <?php endforeach ?>
        </ul>
    </div>
    <div><h2><?= "Le prix de votre glace est de : $coutTotal €" ?></h2></div>
</form>

<br>

<?php require 'footer.php'; ?>

