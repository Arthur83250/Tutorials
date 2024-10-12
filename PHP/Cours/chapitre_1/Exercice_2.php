<?php

//Déclarer le tableau suivant : une entreprise ATILA possède des bureaux dans plusieurs villes : Lyon, Marseille, Paris, Orléans.
//Chaque ville possède un nombre d'employés respectivement 10, 25, 59, 4.
//Calculer la moyenne du nombre d'employé.
//Afficher le résultat dans une phrase : "Chez ATILA, nous employons en moyenne (arrondir au supérieur) "" employés".

$atila = [
    "Lyon" => 10,
    "Marseille" => 25,
    "Paris" => 59,
    "Orléans" => 4,
];

$totalEmployes = 0;

$totalEmployes = array_sum($atila);
$nbVilleAtila = count($atila);

$moyenneNbEmployesAtila = ceil($totalEmployes / $nbVilleAtila);

echo "Chez Atila, nous employons en moyenne $moyenneNbEmployesAtila employés.";
