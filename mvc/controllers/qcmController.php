<?php
// Maxence Persello

function qcmController(): void {
    head('Questionnaires');
    heading();

    nav();

    include_once 'views/questionnaires.php';

    footer(0);
}
?>
