<?php //Maxence Persello

define('BD_NAME', 'projet_daw');
define('BD_USER', 'projet_daw_u');
define('BD_PASS', 'projet_daw_p');
define('BD_SERVER', 'localhost');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

/* FONCTIONS */

function bdErreurExit(array $err): void {
    ob_end_clean(); // Suppression de tout ce qui a pu être déjà généré

    echo '<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8">',
        '<title>Erreur base de données',
        '</head><body><h4>', $err['titre'], '</h4>',
        '<pre><strong>Erreur PDO</strong> : ',  $err['code'], "\n",
        $err['message'], "\n";
    if (isset($err['autres'])){
        echo "\n";
        foreach($err['autres'] as $cle => $valeur){
            echo    '<strong>', $cle, '</strong> :', "\n", $valeur, "\n";
        }
    }
    echo    "\n",'<strong>Pile des appels de fonctions :</strong>', "\n", $err['appels'],
        '</pre></body></html>';
    exit(1);
}

function bdConnect(): PDO {
    try {
        $conn = new PDO('mysql:host='.BD_SERVER.';dbname='.BD_NAME, BD_USER, BD_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn->exec("SET NAMES 'utf8'");
        return $conn;
    } catch (PDOException $e) {
        $err['titre'] = 'Erreur de connexion';
        $err['code'] = $e->getCode();
        $err['message'] = $e->getMessage();
        $err['appels'] = $e->getTraceAsString();
        $err['autres'] = array('Paramètres' =>   'BD_SERVER : '. BD_SERVER
            ."\n".'BD_USER : '. BD_USER
            ."\n".'BD_PASS : '. BD_PASS
            ."\n".'BD_NAME : '. BD_NAME);
        bdErreurExit($err); // ==> ARRET DU SCRIPT
    }
}

function encode_json(PDOStatement $result): string {
    $json_resultat = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $json_row = json_encode($row);
        $json_resultat[] = $json_row;
    }
    return json_encode($json_resultat);
}



function head(string $title, string $prefixe = '.', string $css = 'style2.css'):void {
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
        '<h1 id="ploodle">PLOODLE</h1>',
        '</header>';
}

function nav(string $prefixe = '.'):void {
    echo '<nav>',
    '<ul id="navigation">',
        '<li><a href='.$prefixe.'/>Accueil</a></li>',
        '<li><a href='.$prefixe.'/?route=forum>Forum</a></li>',
        '<li><a href="'.$prefixe.'/?route=cours">Cours</a></li>',
        '<li id="user">';
    if (isset($_SESSION['usLogin'])) {
        if (isset($_SESSION['usAdmin']) && $_SESSION['usAdmin']) {
            echo '<span class="clickable">'.$_SESSION['usPrenom'],' ',$_SESSION['usNom'].' &#9662</span>',
            '<div id="sidebar">',
                '<ul>',
                    '<li><a href="'.$prefixe.'/?route=profil">Profil</a></li>',
                    '<li><a href="'.$prefixe.'/?route=gestion_user">Utilisateurs</a></li>',
                    '<li><a href="'.$prefixe.'/?route=auth">Déconnexion</a></li>',
                '</ul>',
            '</div>',
        '</li>';
        } else {
            echo '<span class="clickable">'.$_SESSION['usPrenom'],' ',$_SESSION['usNom'].' &#9662</span>',
                '<div id="sidebar">',
                    '<ul>',
                        '<li><a href="'.$prefixe.'/?route=profil">Profil</a></li>',
                        '<li><a href="'.$prefixe.'/?route=questionnaires">Questionnaires</a></li>',
                        '<li><a href="'.$prefixe.'/?route=auth">Déconnexion</a></li>',
                        '</ul>',
                '</div>',
            '</li>';
        }
    } else {
        echo '<a href="'.$prefixe.'/?route=auth">Connexion</a></li>';
    }
    echo '</ul>',
    '</nav>',
    '<main>';
}

function footer(int $showRetour = 1, string $prefixe = '.'):void {
    if($showRetour) {
        echo '<footer>',
            '<p><a href="javascript:history.go(-1)">Retour</a>',
        '</footer>';
    }

    echo '</main></div></body></html>';
}