<?php // Maxence Persello & Alexis

echo '<section>',
    '<h1>Page Principale</h1>',
    '<table>';

    foreach ($lstCours as $cour) 
    {   
        echo '<tr><td><label for="'.$cour['paID'].'">'.$cour['paTitre'].'</label></td>',
        '<td><a href="?route=cours&page='.$cour['paID'].'">Ouvrir</a></td>';

    }

    echo '</table>',
    '</section>';

if (isset($_SESSION['usAdmin']) && $_SESSION['usAdmin']) {
    echo '<section>';
    if (isset($_GET['newpage'])) {
        echo '<form method="post">',
            '<label for="titreInput">Titre du cours</label>',
            '<input type="text" id="titreInput" oninput="updateTitre()">',
            '<label for="categorieInput">Formation</label>',
            '<select id="categorieInput" onchange="updateCategorie()">',
                '<option value="1">Mathématiques</option>',
                '<option value="2">Histoire</option>',
                '<option value="3">Sciences</option>',
            '</select>',
            '<label for="niveauInput">Niveau</label>',
            '<select id="niveauInput" onchange="updateNiveau()">',
                '<option value="L1">Licence 1</option>', 
                '<option value="L2">Licence 2</option>',
                '<option value="L3">Licence 3</option>',
                '<option value="M1">Master 1</option>',
                '<option value="M2">Master 2</option>',
            '</select>',
            '<input type="submit" name="btnNewPage"/>',
        '</form>';
    } else {
        echo '<a href="?route=cours&newpage">Ajouter un cours</a>';
    }
    echo '</section>';
}
