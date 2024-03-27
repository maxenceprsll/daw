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


function addCours($categorie, $niveau, $titre) {
    $db = bdConnect();

    $paUser = $_SESSION['usID'];

    $sql = "INSERT INTO pageCours(paCategorieID, paTitre, paNiveau, paUser) VALUES (:C, :T, :N, :U)";
    $req = $db->prepare($sql);
    $req->bindParam(':C', $categorie);
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

    $result = $req->execute();

    $db = null;

    return $result;
}

function getlstCours() {
    $db = bdConnect();

    $sql = "SELECT paID, paTitre, foIntitule, niShort, usNom, usPrenom FROM pageCours, formation, user, niveau WHERE paFormationID = foID AND paUser = usID AND paNiveau = niID";
    $resultat = $db->query($sql);
    $liste = $resultat->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $liste;
}

function getFormations() {
    $db = bdConnect();

    $sql = "SELECT * FROM formation";
    $resultat = $db->query($sql);
    $liste = $resultat->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $liste;
}

function getNiveaux() {
    $db = bdConnect();

    $sql = "SELECT * FROM niveau";
    $resultat = $db->query($sql);
    $liste = $resultat->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $liste;
}