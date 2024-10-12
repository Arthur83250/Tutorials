<?php 
$error = null;
$success = null;
if (!empty($_POST['email'])){
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'emails' . DIRECTORY_SEPARATOR . date('Y-m-d');
        file_put_contents($file, $email . PHP_EOL, FILE_APPEND);
        $success = 'Votre email a bien été enregistré';
        $email = null;
    }else{
        $error = 'email invalide';
    }
}
require 'elements/header.php'; 
?><br>


<div class="container">

    <h3>S'inscrire à la Newsletter</h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur blanditiis natus alias eius ut architecto necessitatibus rem at in? Velit debitis sequi fugiat neque cum sunt similique cumque delectus saepe.</p>

    <?php if($error): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>
    
    <?php if($success): ?>
        <div class="alert alert-success">
            <?= $success ?>
        </div>
    <?php endif; ?>

</div><br>


<?php require 'elements/footer.php'; ?>