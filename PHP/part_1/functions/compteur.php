<?php

function nombre_vues_mois (int $annee, string $mois): int{
    $mois = str_pad($mois, 2, '0' , STR_PAD_LEFT);
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-' . $annee . '-' . $mois . '-' . '*';
    $fichiers = glob($fichier);
    $total = 0;
    foreach($fichiers as $fichier){
        $total += (int)file_get_contents($fichier);
    }
    return $total;
}

function nombre_vues_detail_mois (int $annee, string $mois) {
    $mois = str_pad($mois, 2, '0' , STR_PAD_LEFT);
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-' . $annee . '-' . $mois . '-' . '*';
    $fichiers = glob($fichier);
    $visites = [];
    foreach($fichiers as $fichier){
        $parties = explode('-', basename($fichier));
        $visites[] = 
        [
            'annee' => $parties[1],
            'mois' => $parties[2],
            'jour' => $parties[3],
            'visites' => file_get_contents($fichier)
        ];
        return $visites;
    }
}