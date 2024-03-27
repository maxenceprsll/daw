<?php //Maxence Persello & Alexis

function getAllElements($numPages): array {
    $db = bdConnect();

    $query = "SELECT * FROM elementCours WHERE elCoursID = :n";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':n', $numPages);
    $stmt->execute();
    $article = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $article;
}

function getTitre($numPages) {
    $db = bdConnect();

    $query = "SELECT paTitre FROM pageCours WHERE paID = :n";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':n', $numPages);
    $stmt->execute();
    $titre = $stmt->fetch(PDO::FETCH_ASSOC);

    $db = null;

    return $titre;
}


function addCours($formation, $niveau, $titre) {
    $db = bdConnect();

    $paUser = $_SESSION['usID'];

    $sql = "INSERT INTO pageCours(paFormationID, paTitre, paNiveau, paUser) VALUES (:C, :T, :N, :U)";
    $req = $db->prepare($sql);
    $req->bindParam(':C', $formation);
    $req->bindParam(':T', $titre);
    $req->bindParam(':N', $niveau);
    $req->bindParam(':U', $paUser);
    $req->execute();

    $db = null;
}


function addElem($coursid,$type,$val,$format) {
    $db = bdConnect();

    $sql = "INSERT INTO elementCours(elCoursID, elType, elContenu, elFormat) VALUES (:I, :T, :C, :F)";
    $req = $db->prepare($sql);
    $req->bindParam(':I', $coursid);
    $req->bindParam(':T', $type);
    $req->bindParam(':C', $val);
    $req->bindParam(':F', $format);

    $req->execute();

    $db = null;
}

function getlstCours(): array {
    $db = bdConnect();

    $sql = "SELECT paID, paTitre, foIntitule, niShort, usNom, usPrenom FROM pageCours, formation, user, niveau WHERE paFormationID = foID AND paUser = usID AND paNiveau = niID";
    $resultat = $db->query($sql);
    $liste = $resultat->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $liste;
}

function getFormations(): array {
    $db = bdConnect();

    $sql = "SELECT * FROM formation";
    $resultat = $db->query($sql);
    $liste = $resultat->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $liste;
}

function getNiveaux(): array {
    $db = bdConnect();

    $sql = "SELECT * FROM niveau";
    $resultat = $db->query($sql);
    $liste = $resultat->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $liste;
}

function removeElement($elID): void {
    $db = bdConnect();

    $sql = "DELETE FROM elementCours WHERE elID = :elID";
    $req = $db->prepare($sql);
    $req->bindParam(':elID', $elID);

    $req->execute();

    $db = null;
}

function removePage($paID): void {
    $db = bdConnect();

    $sql = "DELETE FROM elementCours WHERE elCoursID = :paID";
    $req = $db->prepare($sql);
    $req->bindParam(':paID', $paID);
    $req->execute();

    $sql = "DELETE FROM pageCours WHERE paID = :paID";
    $req = $db->prepare($sql);
    $req->bindParam(':paID', $paID);
    $req->execute();

    $db = null;
}