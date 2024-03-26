<?php // Maxence Persello

require_once 'models/userModel.php';

function userController(): void {

    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';

    head('Gestion Utilisateurs');
    heading();
    nav();

    $input =isset($_POST['input'])?$_POST['input']:'';

    echo '<section>',
    '<h2>Liste des Utilisateurs</h2>',
    '<input type="text" id="searchInput" oninput="getUsers()" placeholder="Nom, Prenom ou Login">',
    '<a href=?route=add_user>Ajouter un Utilisateur</a>',
    '<table id="table_user">';
    ?>
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

function userEditor($usID): void {
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

function userRemove($usID): void {
    if (!$usID) {
        header('Location: index.php');
    }

    head('Suppression Utilisateur');
    heading();
    nav();

    if (isset($_POST['btnRemove'])) {
        removeUser($usID);
        header('Location: ?route=gestion_user');
    } else {
        $user = getUser($usID);
        include_once 'views/user_remover.php';
    }
    

    footer();
}

function userAdd(): void {
    head('Ajout Utilisateur');
    heading();
    nav();

    if (isset($_POST['btnAdd'])) {
        addUser();
        header('Location: ?route=gestion_user');
    } else {
        include_once 'views/user_adder.php';
    }
    

    footer();
}