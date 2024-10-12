<?php

require_once '../vendor/autoload.php';
require_once 'pdoInit.php';

$error = null;

try {
    if (isset($_POST['name'], $_POST['content'])){
        $query = $pdo->prepare('INSERT INTO posts (name, content, create_at) VALUES (:name, :content, :created)');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created' => time()
        ]);
        header('Location: /blog/edit.php?id=' . $pdo->lastInsertId());
        exit();
    }
    $query = $pdo->query('SELECT * FROM posts');
    /**
     * @var Post[]
     */
    $posts = $query->fetchAll(PDO::FETCH_CLASS, 'App\Post');
} catch (PDOException $e) {
    $error = $e->getMessage();
}

require '../elements/header.php'; ?>

<div class="container">
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php else: ?>
        <ul>
            <?php foreach ($posts as $post): ?>
                <?php dump($post); ?>
                <h2><li><a href="/blog/edit.php?id=<?= $post->id ?>"><?= htmlentities($post->name) ?></a></li></h2>
                <p class="small text-muted">Ecrit le <?= $post->create_at->format('d/m/Y à H:i') ?></p>
                <p>
                    <?= $post->getBody() ?>
                </p>
            <?php endforeach ?>
        </ul>

        <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" value="">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content"></textarea>
                </div>
                <button class="btn btn-primary">Sauvegarder</button>
            </form>

    <?php endif ?>
</div>


<?php require '../elements/footer.php'; ?>
