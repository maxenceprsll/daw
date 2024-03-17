<?php //Maxence Persello & Johann

require_once 'bibli_generale.php';

head('Questionnaires');
nav();

aff_index();

footer();

/*FONCTIONS*/

function aff_index(): void {
   echo '<section>',
        '<form class="sessionForm" action="PageQCM.php" method="POST">',
            '<ul>',
                '<li><label for="categorie">Categorie</label></li>',
                '<li><input type="text" name="categorie"></li>',
                '<li><input type="submit"></li>',
            '</ul>',
        '</form>',
    '</section>';
}
