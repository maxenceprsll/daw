<?php // Maxence Persello

function errorController(): void {
    head('404');
    heading();

    nav();

    include_once 'views/error.php';

    footer();
}