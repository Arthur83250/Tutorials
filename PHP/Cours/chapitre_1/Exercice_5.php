<?php

//dans la classe il y a 12 elèves : Jean 18, Maxime 20, Agathe 7 15, Julien 5, Roxane 6, David 15, Baptiste 12, Benjamin, Julia 9, Rose16, Emilie14, Stephane17.
//chaque eleve à eu 1 note sauf Benjamin et Agathe qui ont eu respectivement 3 et 2.
//A la récréation, 3 élèves sont allés à l'infirmerie, les effacer du tableau (Maxime, Baptiste et Julia).
//Calculer la moyenne générale de classe en prenant en compte les eleves qui ont eu moins de 3 notes et ceux qui sont partis.
//"la classe composé de "" eleves a eu "" de moyenne générale.

$eleves = [
    "Jean" => [18],
    "Maxime" => [20],
    "Agathe" => [7, 15],
    "Julien" => [5],
    "Roxane" => [6],
    "David" => [15],
    "Baptiste" => [12],
    "Benjamin" => [10, 12, 8],
    "Julia" => [9],
    "Rose" => [16],
    "Emilie" => [14],
    "Stephane" => [17]
];

$toErase = ["Roxane", "Julia", "Julien"];

foreach ($toErase as $nom){    
    unset($eleves[$nom]);
}
var_dump($eleves);

$elevesSum = 0;

foreach ($eleves as $eleve => $notes)
{
    $elevesSum += array_sum($notes) / count($notes);
}

$nbEleves = count($eleves);
$moyenne = ceil($elevesSum / $nbEleves);

echo "la classe composée de $nbEleves élèves a eu $moyenne de moyenne générale.";
