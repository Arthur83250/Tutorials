<?php

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

function nav_menu(string $linkClass=''): string
{
    return 
    nav_item('/index.php', 'Accueil', $linkClass) .
    nav_item('/contact.php', 'Contact', $linkClass) .
    nav_item('/menu.php', 'Menu', $linkClass);
}

function dump ($variable){
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
}

function creneaux_html (array $creneaux)
    {
        $phrases = [];
        if (empty($creneaux)){
            return 'Fermé';
        }
        foreach ($creneaux as $creneau){
            $phrases[] = "de <strong>{$creneau[0]}h</strong> à <strong>{$creneau[1]}h</strong>";
        }
        return 'Ouvert ' . implode(' et ', $phrases);
    }
    
function in_creneaux (int $heure, array $creneaux)
    {
        foreach ($creneaux as $creneau){
            $debut = $creneau[0];
            $fin = $creneau[1];
            if ($heure >= $debut && $heure <= $fin){
                return true;
            }
        }
        return false;
    }
?>