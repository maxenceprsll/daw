<?php // Maxence Persello

echo '<section class="sessionForm">',
    '<h3>Suppression d\'un utilisateur</h3>',
    '<form method="POST">',
        '<ul>',
            '<li><label for="login">Login</label></li>',
            '<li>'.(isset($user['usLogin'])?$user['usLogin']:'').'</li>',
            '<li><label for="nom">Nom</label></li>',
            '<li>'.(isset($user['usNom'])?$user['usNom']:'').'</li>',
            '<li><label for="prenom">Prénom</label></li>',
            '<li>'.(isset($user['usPrenom'])?$user['usPrenom']:'').'</li>',
            '<li id="btnAdmin">',
            '<li><input type="submit" name="btnRemove" value="Supprimer"></li>',
        '</ul>',
    '</form>',
'</section>';