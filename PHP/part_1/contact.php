<?php

$title = "Nous contacter";
require_once 'data/config.php';
require_once 'functions.php';
require 'elements/header.php';


// Définir le timzone
date_default_timezone_set('Europe/Paris');

//Récupérer l'heure et le jour demandés sinon l'heure actuelle 
$heure = (int)($_GET['heure'] ?? date('G'));
$jour = (int)($_GET['jour'] ?? date('N') - 1);

//Récupérer les créneaux demandés sinon d'aujourd'hui
$creneaux = CRENEAUX[date('N') - 1];

//Récupérer l'état d'ouverture du magasin
$ouvert = in_creneaux($heure, $creneaux);
$color = $ouvert ? 'green' : 'red';
if ($ouvert){$color = 'green';}else{$color ='red';}

?>

<div class="container">

<!-- NOUS CONTACTER -->

    <div class="row">
        <div class="col-md-8">
            <h2>Nous Contacter</h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla obcaecati itaque minima, minus sint hic architecto illo numquam accusamus ipsum est ut aspernatur inventore. Eius molestias explicabo a laudantium id.</p>
        </div>
    </div>    

<!-- FIN NOUS CONTACTER -->
    
    <div class="col-md-4"><br>
        <h4>Quand souhaitez-vous passer?</h4>

        <!-- ALERTE OUVERT OU FERME -->
        <?php if ($ouvert): ?>
            <div class="alert alert-success">
                Le magasin sera ouvert
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                Le magasin sera fermé
            </div>
        <?php endif; ?>
        <!-- FIN ALERTE -->

        <!-- FORMULAIRE -->        
        <form action="/contact.php" method="GET">
         <div class="form-group">
            <?= select('jour', $jour, JOURS) ?>
         </div> 
         <div class="form-group">
            <input class="form-control" type="number" name="heure" value="<?= $heure ?>">
         </div>
         <button class="btn btn-primary" type="submit">Voir si le magasin est ouvert</button>       
        </form>
    </div>
    <!-- FIN FORMULAIRE -->

    <!-- HORAIRES -->
    <div class="col-md-4">
        <h2>Horaires d'ouverture</h2>
        <ul>
            <?php foreach(JOURS as $k => $jour): ?>                    
                <li>
                    <strong><?= $jour ?></strong> :
                    <?= creneaux_html(CRENEAUX[$k]); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- FIN HORAIRES -->
</div>
    
<?php require 'elements/footer.php'; ?>