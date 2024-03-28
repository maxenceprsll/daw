<?php // Maxence Persello

function getUsers(): array {

    $db = bdConnect();

    $query = "SELECT usID, usLogin, usNom, usPrenom FROM user";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;
    
    return $users;
}

function getUser($usID): array {

    $db = bdConnect();

    $query = "SELECT usID, usLogin, usNom, usPrenom, usAdmin FROM user WHERE usID = :usID";
    $stmt = $db->prepare($query);
    $stmt->execute(array(':usID' => $usID));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $db = null;
    
    return $user;
}

function updateUser($usID): void {

    $db = bdConnect();

    $admin = isset($_POST['admin'])?1:0;

    $query = "UPDATE user SET usLogin = :usLogin, usNom = :usNom, usPrenom = :usPrenom, usAdmin = :usAdmin WHERE usID = :usID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':usLogin', $_POST['login']);
    $stmt->bindParam(':usNom', $_POST['nom']);
    $stmt->bindParam(':usPrenom', $_POST['prenom']);
    $stmt->bindParam(':usAdmin', $admin);
    $stmt->bindParam(':usID', $usID);
    $stmt->execute();

    $db = null;
}

function removeUser($usID): void {
    $db = bdConnect();

    $query = "DELETE FROM user WHERE usID = :usID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':usID', $usID);
    $stmt->execute();

    $db = null;
}

function addUser(): void {
    $db = bdConnect();

    $usLogin = $_POST['login'];
    $usNom = $_POST['nom'];
    $usPrenom = $_POST['prenom'];
    $usPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $admin = isset($_POST['admin'])?1:0;

    $query = "INSERT INTO user(usLogin, usNom, usPrenom, usAdmin, usPass, usNiveau, usFormation) VALUES (:usLogin, :usNom, :usPrenom, :usAdmin, :usPass, 0, 0)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':usLogin', $_POST['login']);
    $stmt->bindParam(':usNom', $_POST['nom']);
    $stmt->bindParam(':usPrenom', $_POST['prenom']);
    $stmt->bindParam(':usPass', $usPass);
    $stmt->bindParam(':usAdmin', $admin);
    $stmt->execute();

    $db = null;
}