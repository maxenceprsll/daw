<?php // Maxence Persello

require_once 'models/coursModel.php';

function coursController(): void {
    head('Cours');
    heading();

    nav();

    if(isset($_POST['btnNewPage'])) {
        addCours($_POST['categorie'], $_POST['niveau'], $_POST['titre']);
    }

    if (isset($_GET['page'])) {
        $titre = getTitre($_GET['page']);
        $cours = getAllElements($_GET['page']);
        include_once 'views/cours_page.php';
    } else {
        $formations = getFormations();
        $niveaux = getNiveaux();
        $lstCours = getlstCours();
        include_once 'views/cours_index.php';
    }
    
    footer();
}