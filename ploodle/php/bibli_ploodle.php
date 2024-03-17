<?php //Maxence Persello

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting( E_ALL );


define ('BD_NAME', 'projet_daw');
define ('BD_USER', 'projet_daw_u');
define ('BD_PASS', 'projet_daw_p');
define ('BD_SERVER', 'localhost');

/*FONCTIONS*/

function head(string $title, string $prefixe = '..', string $css = 'style2.css'):void {
    echo '<!DOCTYPE html>',
    '<html lang="fr">',
        '<head>',
            '<meta charset="UTF-8">',
            '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
            '<link rel="stylesheet" href="'.$prefixe.'/styles/'.$css.'">',
            '<title>'.$title.'</title>',
        '</head>',
        '<body>',
            '<div id="display">';
}

function heading() {
    echo '<header class="box">',
        '<h1 id="titre">PLOODLE</h1>',
        '</header>';
}

function nav(string $prefixe = '..'):void {
    echo '<nav>',
    '<ul id="navigation">',
        '<li><a href='.$prefixe.'/index.php>Ploodle</a></li>',
        '<li id="user">';
    if (isset($_SESSION['usLogin'])) {
        echo '<span class="clickable">'.$_SESSION['usPrenom'],' ',$_SESSION['usNom'].'</span>',
            '<div id="sidebar">',
                '<ul>',
                    '<li><h3>',$_SESSION['usLogin'],'</h3></li>',
                    '<li><a href="'.$prefixe.'/php/deconnexion.php">Déconnexion</a></li>',
                    '<li><a href="'.$prefixe.'/php/profil.php">Profil</a></li>',
                    '<li><a href="'.$prefixe.'/php/questionnaires.php">Questionnaires</a></li>',
                    '<li><a href="#">Menu Item 4</a></li>',
                    '<li><a href="#">Menu Item 5</a></li>',
                '</ul>',
            '</div>',
        '</li>';
    } else {
        echo '<a href="'.$prefixe.'/php/login.php">Connexion</a></li>';
    }
    echo '</ul>',
'</nav>',
'<main>';
}

function footer(string $prefixe = '..'):void {
echo '<div id="notification" class="notification"></div>',
'</main></div></body>',
'<script>',
    'function showNotification(message, color=\'#444\', time=\'1500\') {',
        'var notification = document.getElementById(\'notification\');',
        'notification.innerHTML = message;',
        'notification.style.top = \'10px\';',
        'notification.style.background = color;',
        'setTimeout(function() {',
          'notification.style.top = \'-100px\';',
        '}, time);',
    '}';
    if(isset($_SESSION['loggedin'])) {
        if($_SESSION['loggedin'] === true) {
            echo "showNotification('Connexion réussie.','#4db54f');";
        } else {
            echo "showNotification('Déconnexion réussie.','#b54d4f');";
        }
        unset($_SESSION['loggedin']);
    }
    echo '</script></html>';
}