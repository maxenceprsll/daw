<?php // Maxence Persello

if (isset($_SESSION['usAdmin']) && $_SESSION['usAdmin']) {
    if (isset($_GET['addPage'])) {
        echo '<section class="sessionForm">',
            '<form method="POST">',
                '<ul>',
                    '<li><label for="titre">Titre du cours</label></li>',
                    '<li><input type="text" name="titre" id="titre"></li>',
                    '<li><label for="formation">Formation</label></li>',
                    '<li><select name="formation" id="formation">';

                    foreach ($formations as $option) {
                        echo '<option value="'.$option['foID'].'">'.$option['foIntitule'].'</option>';
                    }

                    echo '</select></li>',
                    '<li><label for="niveau">Niveau</label></li>',
                    '<li><select name="niveau" id="niveau">';
                    
                    foreach ($niveaux as $option) {
                        echo '<option value="'.$option['niID'].'">'.$option['niIntitule'].'</option>';
                    }

                    echo '</select></li>',
                    '<li><input type="submit" name="btnNewPage" value="Ajouter un cours"/></li>',
                '</ul>',
            '</form>';
    } else {
        echo '<a href="?route=cours&addPage" class="button">Ajouter un cours</a>';
    }
    echo '</section>';
}
