<?php // Maxence Persello

function getProfil($usID): array {

    $db = bdConnect();

    $query = "SELECT usLogin, usNom, usPrenom, usNiveau, niIntitule, usFormation, foIntitule FROM user, niveau, formation WHERE usID = :I AND usNiveau = niID AND usFormation = foID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':I', $usID);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $db = null;
    
    return $user;
}

function saveProfil($usID): void {
    $db = bdConnect();

    $query = "UPDATE user SET usFormation = :foID, usNiveau = :niID WHERE usID = :usID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':foID', $_POST['formation']);
    $stmt->bindParam(':niID', $_POST['niveau']);
    $stmt->bindParam(':usID', $usID);

    $stmt->execute();

    $db = null;
}