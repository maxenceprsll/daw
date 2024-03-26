<?php // Maxence Persello

require_once 'models/coursModel.php';

function coursController(): void {
    head('Cours');
    heading();

    nav();

    if(isset($_POST['btnNewPage'])) {
        addCours($_POST['categorie'], $_POST['niveau'], $_POST['titre']);
        header('Location: ?route=cours');
    }

    if (isset($_GET['page'])) {
        $titre = getTitre($_GET['page']);
        $cours = getAllElements($_GET['page']);
        include_once 'views/page_cours.php';
    } else {
        $lstCours = getlstCours();
        include_once 'views/index_cours.php';
    }
    
    footer();
}