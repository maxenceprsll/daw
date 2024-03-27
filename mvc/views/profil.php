<?php // Maxence Persello

echo '<section>',
    '<h1>Profil</h1>';
if (isset($_GET['editProfil'])) {
        echo '<form method="POST">',
            '<ul id="profil">',
                '<li><strong>Login</strong></li>',
                '<li>' . $user['usLogin'] . '</li>',
                '<li><strong>Nom</strong></li>',
                '<li>' . $user['usNom'] . '</li>',
                '<li><strong>Prénom</strong></li>',
                '<li>' . $user['usPrenom'] . '</li>';
            
                echo '<li><label for="formation"><strong>Formation</strong></label></li>',
                '<li><select name="formation" id="formation">';
                foreach ($formations as $formation) {
                    $selected = ($formation['foID'] == $user['usFormation']) ? 'selected' : '';
                    echo '<option value="' . $formation['foID'] . '" ' . $selected . '>' . $formation['foIntitule'] . '</option>';
                }
                echo '</select></li>';

                echo '<li><label for="formation"><strong>Niveau</strong></label></li>',
                '<li><select name="niveau" id="niveau">';
                foreach ($niveaux as $niveau) {
                    $selected = ($niveau['niID'] == $user['usNiveau']) ? 'selected' : '';
                    echo '<option value="' . $niveau['niID'] . '" ' . $selected . '>' . $niveau['niIntitule'] . '</option>';
                }
                echo '</select></li>',
                '<input type="submit" name="btnProfil" value="Enregistrer"/>',
            '</ul>',
        '</form>',
    '</section>';
} else {
        echo '<ul id="profil">',
            '<li><strong>Login</strong></li>',
            '<li>' . $user['usLogin'] . '</li>',
            '<li><strong>Nom</strong></li>',
            '<li>' . $user['usNom'] . '</li>',
            '<li><strong>Prénom</strong></li>',
            '<li>' . $user['usPrenom'] . '</li>',
            '<li><strong>Formation</strong></li>',
            '<li>' . $user['foIntitule'] . '</li>',
            '<li><strong>Niveau</strong></li>',
            '<li>' . $user['niIntitule'] . '</li>',
        '</ul>',
    '</section>',
    '<a href="?route=profil&editProfil" class="button">Editer le profil</a>';
}