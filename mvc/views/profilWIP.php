<?php //Maxence Persello

require_once 'bibli_generale.php';

head('Profil');
nav();

aff_profil();

footer();

/*FONCTIONS*/

function aff_profil():void {
    if (isset($_SESSION['usLogin'])) {
        $login = $_SESSION['usLogin'];
    } else {
        header('location: login.php');
        exit;
    }

    echo 
    '<section>',
    '<h2>Profil de ',$_SESSION['usLogin'],'</h2>',
    '<p>User ID: ',$_SESSION['usID'],'</p>',
    '<p>Nom: ',$_SESSION['usNom'],'</p>',
    '<p>Prenom: ',$_SESSION['usPrenom'],'</p>',
    '<p>Est admin:',$_SESSION['usAdmin'],'</p>',
    '</section>';
}