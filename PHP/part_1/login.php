<?php 
$error = null;
$password = '$2y$14$jjzuNAa9mcvuSMSAdCnBXOG/3bHuel2hfOOHfM9vTJK3g0WaYfGBG';
if (!empty($_POST['pseudo']) && !empty($_POST['motdedepasse'])){
    if ($_POST['pseudo'] === 'John' && password_verify($_POST['motdedepasse'], $password)){
        session_start();
        $_SESSION['connected'] = 1;
        header('Location: /dashboard.php');
    }else{
        $error = "Identifiants incorrects";
    }
}

require_once 'functions/auth.php';
if (is_connected()){
    header('Location: dashboard.php');
    exit();
}

require_once 'elements/header.php'; ?>



<div class="container">
    <?php if ($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php endif; ?>
    <form action="" method="post">
        <div class="form-group mb-2">
            <input class="form-control" type="text" name="pseudo" placeholder="Entrez votre nom d'utilisateur">
        </div>
        <div class="class-group mb-2">
            <input class="form-control" type="password" name="motdedepasse" placeholder="Entrez votre mot de passe">
        </div>
        <button  type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>


<?php require 'elements/footer.php'; ?>