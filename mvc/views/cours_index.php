<?php // Maxence Persello & Alexis

echo '<section>',
    '<h1>Cours</h1>',
    '<table class="table">',
        '<tr>',
            '<th>Nom du cours</th>',
            '<th>Auteur</th>',
            '<th>Formation</th>',
            '<th>Niveau</th>',
            '<th col-span="2">Actions</th>';

foreach ($lstCours as $cour) 
{   
    echo '<tr>',
            '<td>'.$cour['paTitre'].'</td>',
            '<td>'.$cour['usNom'].' '.$cour['usPrenom'].'</td>',
            '<td>'.$cour['foIntitule'].'</td>',
            '<td>'.$cour['niShort'].'</td>',
            '<td><a href="?route=cours&page='.$cour['paID'].'">Ouvrir</a></td>',
        '</tr>';
}

echo '</table>',
'</section>';

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
