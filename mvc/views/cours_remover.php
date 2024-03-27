<?php // Maxence Persello

echo '<section class="sessionForm">',
    '<h3>Suppression d\'un cours</h3>',
    '<form method="POST">',
        '<ul>',
            '<li><label for="titre">Titre</label></li>',
            '<li>'.(isset($page['paTitre'])?$page['paTitre']:'').'</li>',
            '<li><input type="submit" name="btnRemove" value="Supprimer"></li>',
        '</ul>',
    '</form>',
'</section>';