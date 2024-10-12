<?php

$error = null;
$password = '$2y$10$4ozjOwxqDtYmuprD2M9Cx.9YFZklu.Kk2EB7/5Q0gCXhOu0JvDv92';
if(!empty($_POST['user']) && !empty($_POST['password'])){
    if($_POST['user'] === 'John' && password_verify($_POST['password'], $password)){
        session_start();
        $_SESSION['connected'] = 1;
        header('Location: dashboard.php');
        exit();
    }else{
        $error = "Identifiants incorrects";
    }
}

require_once 'functions/auth.php';
if (is_connected()) {
    header('Location: /dashboard.php');
    exit();
}

require_once 'elements/header.php';

?>

<div class="container mt-4 w-25 text-center">
    <?php if($error): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>   
    <?php endif; ?>
    <form action="" method="post">
        <div class="form-group">
            <input class="form-control mb-3" type="text" name="user" placeholder="Nom d'utilisateur">
            <input class="form-control mb-3" type="password" name="password" placeholder="Votre mot de passe">
            <button class="btn btn-primary" type="submit" class="btn btn-primary">Se connecter</button>
        </div>
    </form>
</div>


<?php

require 'elements/footer.php';

?>