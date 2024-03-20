<?php
// Maxence Persello

require_once 'models/userModel.php';

function userController(): void {

    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';

    head('Gestion Utilisateurs');
    heading();
    nav();

    $input =isset($_POST['input'])?$_POST['input']:'';

    echo '<section>';
    echo '<h2>Liste des Utilisateurs</h2>';
    echo '<input type="text" id="searchInput" oninput="getUsers()">';
    echo '<table id="table_user">';
    echo '<tr><th>Nom</th><th>Prénom</th><th>Login</th><th>Action</th></tr>'; ?>
    <script>
        $(document).ready(function() {
            getUsers();
        });
        function getUsers() {
            var input = document.getElementById('searchInput').value;
            $.ajax({
                url: 'ajax/userAJAX.php',
                method: 'POST',
                data: { input: input },
                success: function(response) {
                    $('#table_user').html(response);
                }
            });
        }
    </script>
    <?php
    echo '</table>';
    echo '</section>';

    footer();
}

function userEditor($usID = 0): void {
    if (!$usID) {
        header('Location: index.php');
    }

    head('Edition Utilisateur');
    heading();
    nav();

    if (isset($_POST['btnEditeur'])) {
        updateUser($usID);
        header('Location: ?route=gestion_user');
    } else {
        $user = getUser($usID);
        include_once 'views/user_editor.php';
    }
    

    footer();

}