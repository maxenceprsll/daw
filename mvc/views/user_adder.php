<?php // Maxence Persello

echo '<section class="sessionForm">',
    '<h3>Ajout d\'un utilisateur</h3>',
    '<p>Merci de fournir les informations suivantes.</p>',
    '<form method="POST">',
        '<ul>',
            '<li><label for="login">Login</label></li>',
            '<li><input id="login" name="login" type="text" placeholder="xx123456" required value="'.(isset($user['usLogin'])?$user['usLogin']:'').'"/></li>',
            '<li><label for="nom">Nom</label></li>',
            '<li><input id="nom" name="nom" type="text" required/></li>',
            '<li><label for="prenom">Prénom</label></li>',
            '<li><input id="prenom" name="prenom" type="text" required/></li>',
            '<li><label for="password">Mot de passe</label></li>',
                '<li><input id="password" name="password" type="password" required autocomplete="current-password"></input></li>',
            '<li id="btnAdmin">',
            '<input id="admin" name=admin type="checkbox" value="1"/>',
            '<label for="admin">Statut Administrateur</label></li>',
            '<li><input type="submit" name="btnAdd" value="Créer"></li>',
        '</ul>',
    '</form>',
'</section>';