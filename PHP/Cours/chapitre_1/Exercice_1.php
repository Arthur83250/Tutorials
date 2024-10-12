<?php

//Afficher "Jean a gagné $salaireNet€ net en travaillant chez Auchan"

$salaireBrut = 2300;
$cotisations = 80;

$salireNet = ($salaireBrut * $cotisations) / 100;

echo "Jean a gagné $salireNet € net en travaillant chez Auchan";
