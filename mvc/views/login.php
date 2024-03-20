<?php //Maxence Persello

echo '<section class="sessionForm">',
        '<h3>Connexion</h3>',
        '<p>Pour vous connecter, merci de fournir les informations suivantes.</p>',
        '<form method="POST">',
            '<ul>',
                '<li><label for="login">Login</label></li>',
                '<li><input id="login" name="login" type="text" required autocomplete="login"></input></li>',
                '<li><label for="password">Mot de passe</label></li>',
                '<li><input id="password" name="password" type="password" required autocomplete="current-password"></input></li>',
                '<li><input type="submit" name="btnConnexion" value="Se connecter"></li>',
            '</ul>',
        '</form>',
    '</section>';