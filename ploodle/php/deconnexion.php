<?php //Maxence Persello

require_once 'bibli_generale.php';

head('Deconnexion');
nav();
footer();

unset($_SESSION['usLogin']);
unset($_SESSION['usID']);
unset($_SESSION['usNom']);
unset($_SESSION['usPrenom']);
$_SESSION['loggedin'] = false;

header('Location: ../index.php');