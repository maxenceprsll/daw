<?php // Maxence Persello & Chloé Freissinet

function indexController(): void {
    head('Accueil');
    heading();

    nav();

    include_once 'views/index.php';

    footer(0);
}
?>
