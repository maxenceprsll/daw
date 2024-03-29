<?php // Maxence Persello

require_once 'models/authModel.php';

function authController(): void {
    head('Authentification');
    heading();

    nav();

    if(isset($_SESSION['usLogin'])){
        session_unset();
        session_destroy();
        header('Location: ?');
    } else {
        if (isset($_POST['btnConnexion'])) {
            if(traitementConnexion()) {
                header('Location: ?');
            } else {
                echo '<section><p>Identifiant ou mot de passe incorrect.</p></section>';
                include_once 'views/login.php';
            }
        } else {
            include_once 'views/login.php';
        }
    }

    footer();
}