<?php // Maxence Persello & Alexis

echo '<section>',
    '<h1>Cours</h1>',
    '<table id="table_cours">',
        '<tr>',
            '<th>Nom du cours</th>',
            '<th>Formation</th>',
            '<th>Niveau</th>',
            '<th col-span="2">Actions</th>';

foreach ($lstCours as $cour) 
{   
    echo '<tr>',
            '<td>'.$cour['paTitre'].'</td>',
            '<td>'.$cour['caIntitule'].'</td>',
            '<td>'.$cour['paNiveau'].'</td>',
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
                    '<li><label for="categorie">Formation</label></li>',
                    '<li><select name="categorie" id="categorie></li>',
                        '<option value="1">Mathématiques</option>',
                        '<option value="2">Histoire</option>',
                        '<option value="3">Sciences</option>',
                    '</select>',
                    '<li><label for="niveau">Niveau</label></li>',
                    '<li><select name="niveau" id="niveau"></li>',
                        '<option value="L1">Licence 1</option>', 
                        '<option value="L2">Licence 2</option>',
                        '<option value="L3">Licence 3</option>',
                        '<option value="M1">Master 1</option>',
                        '<option value="M2">Master 2</option>',
                    '</select>',
                    '<li><input type="submit" name="btnNewPage" value="Ajouter un cours"/></li>',
                '</ul>',
            '</form>',
        '</section>';
    } else {
        echo '<section>',
            '<a href="?route=cours&addPage" class="button">Ajouter un cours</a>',
        '</section>';
    }
}
