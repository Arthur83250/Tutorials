<?php

//Constuire les tableaux suivant :
//matériels[focusrite, Jbl, Nvidia]
//Prix[52, 35, 96]
//Associer le matériel au prix respectifs et afficher : La focusrite coute .., la jbl coute .. ect..

$materiels = ["focusrite" => 52, "Jbl" => 35, "Nvidia" => 96];

foreach ($materiels as $materiel => $prix){
    echo "- la $materiel coûte $prix €.\n";
}
