<?php

use App\NumberHelper;
use App\TableHelper;
use App\URLHelper;

define('PER_PAGE', 20);

require 'vendor/autoload.php';
//initialiser la BDD
$pdo = new PDO('sqlite:./products.db', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$query = "SELECT * FROM products";
$queryCount = "SELECT COUNT(id) as count FROM products";

//requête préparée
$params = [];
$sortable = ["id", "name", "price", "city", "adress"];

//Recherche par ville
if (!empty($_GET['q'])){
    $query .= " WHERE city LIKE :city";
    $queryCount .= " WHERE city LIKE :city";
    $params['city'] = '%' . $_GET['q'] . '%';
}

//Organisation
if (!empty($_GET['sort']) && in_array($_GET['sort'], $sortable)){
    $direction = $_GET['dir'] ?? 'asc';
    if (!in_array($direction, ['asc', 'desc'])){
        $direction = 'asc';
    }
    $query .= " ORDER BY " . $_GET['sort'] . " $direction";
}

//pagination
$page = (int)($_GET['p'] ?? 1);
$offset = ($page-1) * PER_PAGE;
$query .= " LIMIT " . PER_PAGE . " OFFSET $offset";

$statement = $pdo->prepare($query);
$statement->execute($params);
$products = $statement->fetchAll();

$statement = $pdo->prepare($queryCount);
$statement->execute($params);
$count = (int)$statement->fetch()['count']; 
$pages = ceil($count / PER_PAGE);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Biens immobiliers</title>
</head>

<body class="p-4">

    <div class="container">
        <h1>Les biens immobilier</h1>

        <form action="GET">
            <div class="form-group mb-4">
                <input class="form-control" type="text" name="q" placeholder="Rechercher par ville" value="<?php htmlentities($_GET['q'] ?? '');  ?>">
            </div>
            <button class="btn btn-primary mb-4">Rechercher</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= TableHelper::sort('id', 'ID', $_GET) ?></th>
                    <th><?= TableHelper::sort('name', 'NOM', $_GET) ?></th>
                    <th><?= TableHelper::sort('price', 'PRIX', $_GET) ?></th>
                    <th><?= TableHelper::sort('city', 'VILLE', $_GET) ?></th>
                    <th><?= TableHelper::sort('address', 'ADRESSE', $_GET) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td>#<?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= NumberHelper::price($product['price']) ?></td>
                        <td><?= $product['city'] ?></td>
                        <td><?= $product['address'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php if ($pages > 1 && $page > 1 ): ?>
            <a href="?<?=URLHelper::withParam($_GET, "p", $page - 1)?>" class="btn btn-primary">Page précédente</a>
        <?php endif ?>

        <?php if ($pages > 1 && $page < $pages): ?>
            <a href="?<?=URLHelper::withParam($_GET, "p", $page + 1)?>" class="btn btn-primary">Page suivante</a>
        <?php endif ?>        
    </div>
</body>

</html>