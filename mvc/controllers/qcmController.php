<?php // Maxence Persello

include_once 'models/qcmModel.php';

function qcmController(): void {
    head('Questionnaires');
    heading();

    nav();

    if (isset($_POST['categorie'])) {
        if(isset($_POST['Valider'])) {
            traitement_reponses();
        } else {
            aff_qcm();
        }
    } else {
        include_once 'views/questionnaires.php';
    }
    

    footer(0);
}
?>
