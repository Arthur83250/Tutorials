<?php

if (!function_exists('nav_item')){
    function nav_item(string $lien, string $titre, string $linkClass = ''): string
    {
      $classe = 'nav-link';
      if ($_SERVER['SCRIPT_NAME'] === $lien){
        $classe = $classe . 'active';
      }
      return <<<HTML
              <li class="$linkClass">
                <a class="$classe" href="$lien">$titre</a>
              </li>
HTML;
    }
}

?>

<?= nav_item('/index.php', 'Accueil', $class); ?>
<?= nav_item('/blog.php', 'Blog', $class); ?> 
<?= nav_item('/contact.php', 'Contact', $class); ?> 