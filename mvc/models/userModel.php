<?php

function getUsers(): array {

    $db = bdConnect();

    $query = "SELECT usID, usLogin, usNom, usPrenom FROM user";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $users;
}

function getUser($usID): array {

    $db = bdConnect();

    $query = "SELECT usID, usLogin, usNom, usPrenom, usAdmin FROM user WHERE usID = :usID";
    $stmt = $db->prepare($query);
    $stmt->execute(array(':usID' => $usID));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $user;
}

function updateUser($usID): int {

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

    return 1;
}