<?php // Maxence Persello

require_once 'models/profilModel.php';
require_once 'models/coursModel.php';

function profilController(): void {
    head('Profil');
    heading();

    nav();

    $usID = $_SESSION['usID'];

    if (isset($_POST['btnProfil'])) {
        saveProfil($usID);
        header('Location: ?route=profil');
    }

    $formations = getFormations();
    $niveaux = getNiveaux();
    $user = getProfil($usID);

    include_once 'views/profil.php';

    footer();
}