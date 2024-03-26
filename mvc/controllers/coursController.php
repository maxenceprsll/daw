<?php // Maxence Persello & Alexis

require_once 'models/coursModel.php';

function coursController(): void {
    head('Cours');
    heading();

    nav();

    if (isset($_GET['page'])) {
        $cours = getAllPages($_GET['page']);
        include_once 'views/page_cours.php';
    } else {
        $lstCours = getlstCours();
        include_once 'views/index_cours.php';
    }
    
    footer();
}