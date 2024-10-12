<?php
require_once 'functions/auth.php';
check_user_connected();

require_once 'functions/counter.php';

$year = (int)date('Y');
$active_year = empty($_GET['year']) ? null : (int)$_GET['year'];
$active_month = empty($_GET['month']) ? null : (int)$_GET['month'];
if($active_year && $active_month){
    $total = view_number_per_month($active_year, $active_month);
    $detail = view_number_per_month_detailed($active_year, $active_month);
}else{
    $total = view_number();
}

$months = [
    '1' => 'January',
    '2' => 'February',
    '3' => 'March',
    '4' => 'April',
    '5' => 'May',
    '6' => 'June',
    '7' => 'July',
    '8' => 'August',
    '9' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December'
];

require_once 'elements/header.php';

?>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="list-group">
                <?php for ($y = $year; $y > ($year - 5); $y--): ?>
                    <a class="list-group-item <?= $active_year === $y ? 'active' : ''; ?>" href="dashboard.php?year=<?= $y ?>"><?= $y ?></a>
                    <?php if ($y === $active_year): ?>
                        <div class="list-group">
                            <?php foreach ($months as $m => $month): ?>
                                <a class="list-group-item <?= $active_month === $m ? 'active' : '';?>" href="dashboard.php?year=<?=$active_year?>&month=<?=$m?>">
                                    <?= $month ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-3 align">
                Visite<?= $total > 1 ? 's' : '' ?> totales : <strong><?= $total ?></strong>
            </div>
            <div class="card p-3 align mt-2">
            <?php if(isset($detail)): ?>
                <h2>Détails des visites pour le mois</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Jour</th>
                            <th>Nbre de visites</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($detail as $ligne): ?>                        
                        <tr>
                           <td><?= $ligne['day'] ?></td> 
                           <td><?= $ligne['visits']?></td> 
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php

require 'elements/footer.php';

?>