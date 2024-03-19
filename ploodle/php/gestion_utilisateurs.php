<?php //Maxence Persello

require_once 'bibli_generale.php';

head('Gestion Utilisateurs');
nav();

aff_page();

footer();

/* FONCTIONS */

function aff_page(): void {
    echo '<section>',
        '<h2>Gestion Utilisateurs</h2>',
        '<p><a href="inscription.php">Ajout utilisateur</a></p>',
    '</section>';
}