<?php 

$age = null;

// Définir le cookie birthday
if (!empty($_POST['birthday'])){
    setcookie('birthday', $_POST['birthday']);
    $_COOKIE['birthday'] = $_POST['birthday'];
}

// Calcuer l'age du cookie
if (!empty($_COOKIE['birthday'])){
    $birthday = (int)$_COOKIE['birthday'];
    $age = (int)date('Y') - $birthday;
}

require 'elements/header.php';
?>

<div class="container">
    <!-- Si l'age est > 18 alors contenu adulte-->
    <?php if ($age >= 18): ?>
        <h3>Du contenu réservé aux adultes</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat repellat optio omnis aut nostrum perferendis earum iste eum similique animi deleniti esse error praesentium, officiis, ea porro? Nemo, natus repellendus?</p>
        
    <?php elseif ($age !== null): ?>
        <div class="alert alert-danger">Vous n'avez pas l'age pour accéder à ce contenu</div>
    <?php else: ?>       
    <form action="/nsfw.php" method="post">
            <h3>Date de Naissance</h3>
            <label for="birthday">Section réservé pour les adultes, entrer votre année de naissance</label>
                <div class="form-group">
                    <select name="birthday" id="birthday" class="form-control">
                        <?php for ($year = 1919; $year < 2025; $year++): ?>
                            <option value="<?= $year ?>"><?= $year ?></option>
                        <?php endfor; ?>                    
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Envoyer</button>    
    </form>
    <?php endif; ?>
</div>

<?php require 'elements/footer.php';?>