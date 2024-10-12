<?php

//Déclarer une variable de TVA de 15%.
//Déclarer un taleau contenant une fraise a 8€, un melon a 7€ et une pastèque a 12€
//calculer la TVA pour chaque produit
//Calculer le prix total.

$tva = 15;
$produits = [
    "fraise" => 8,
    "melon" => 7,
    "pastèque" => 12
];

$total = 0;

foreach($produits as $produit => $prix){
    $total += $prix - (($tva * $prix)/100);
}

var_dump($total);

