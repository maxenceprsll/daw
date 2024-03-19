<?php //Maxence Persello

require_once 'bibli_generale.php';

head('Administration');
nav();

affAdmin();

footer();

/* FONCTIONS */

function affAdmin(): void {

    echo '<section>',
        '<h2>Administration</h2>',
        '<p><a href="gestion_utilisateurs.php">Gestion Utilisateurs</a></p>',
        '<p><a href="gestion_cours.php">Gestion Cours</a></p>',
    '</section>';
}