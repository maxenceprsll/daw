<?php // Maxence Persello

include_once '../php/bibli_generale.php';

$db = bdConnect();

$input =isset($_POST['input'])?'%'.$_POST['input'].'%':'';

if($input) {
    $query = "SELECT usID, usLogin, usNom, usPrenom FROM user WHERE usNom LIKE :inputn OR usPrenom LIKE :inputp OR usLogin LIKE :inputl";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':inputn', $input);
    $stmt->bindParam(':inputp', $input);
    $stmt->bindParam(':inputl', $input);
} else {
    $query = "SELECT usID, usLogin, usNom, usPrenom FROM user";
    $stmt = $db->prepare($query);
}

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($users)) {
    echo '<tr><th>Nom</th><th>Prénom</th><th>Login</th><th colspan="2">Actions</th></tr>';
    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $user['usNom'] . '</td>';
        echo '<td>' . $user['usPrenom'] . '</td>';
        echo '<td>' . $user['usLogin'] . '</td>';
        echo '<td><a href="?route=edit_user&id=' . $user['usID'] . '">Editer</a>';
        echo '<td><a href="?route=remove_user&id='. $user['usID'] .'">Supprimer</a></td>';
        echo '</tr>';
    }
} else {
    echo '<p>Aucun utilisateur ne correspond à la recherche</p>';
}
