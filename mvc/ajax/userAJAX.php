<?php

include_once '../php/bibli_generale.php';

$db = bdConnect();

$input =isset($_POST['input'])?'%'.$_POST['input'].'%':'';

if($input) {
    $query = "SELECT usID, usLogin, usNom, usPrenom FROM user WHERE usNom LIKE :inputn OR usPrenom LIKE :inputp OR usLogin LIKE :inputl";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':inputn', $input, PDO::PARAM_STR);
    $stmt->bindParam(':inputp', $input, PDO::PARAM_STR);
    $stmt->bindParam(':inputl', $input, PDO::PARAM_STR);
} else {
    $query = "SELECT usID, usLogin, usNom, usPrenom FROM user";
    $stmt = $db->prepare($query);
}

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($users)) {
    echo '<tr><th>Nom</th><th>Prénom</th><th>Login</th><th>Actions</th></tr>';
    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $user['usNom'] . '</td>';
        echo '<td>' . $user['usPrenom'] . '</td>';
        echo '<td>' . $user['usLogin'] . '</td>';
        echo '<td><a href="?route=edit_user&id=' . $user['usID'] . '">Editer</a>';
        echo '<a class="remove_user" data-userid="'. $user['usID'] .'">Supprimer</a></td>';
        echo '</tr>';
    }
} else {
    echo '<p>Aucun utilisateur ne correspond à la recherche</p>';
}
