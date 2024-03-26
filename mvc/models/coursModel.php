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

    $sql = "INSERT INTO pageCours(paCategorieID, paTitre, paNiveau) VALUES (:C, :T, :N)";
    $req = $db->prepare($sql);
    $req->bindParam(':C', $categorie);
    $req->bindParam(':T', $titre);
    $req->bindParam(':N', $niveau);
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

    $sql = "SELECT * FROM pageCours, categorie WHERE paCategorieID = caID";
    $resultat = $db->query($sql);
    $liste = $resultat->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $liste;
}

function createTableIfNotExists() {
    $db = bdConnect();

    $sql_create_table = "CREATE TABLE IF NOT EXISTS elementCours (
            elID INT AUTO_INCREMENT PRIMARY KEY,
            elCoursID INT,
            elType VARCHAR(3),
            elContenu TEXT,
            FOREIGN KEY (elCoursID) REFERENCES pageCours(paID)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $db->exec($sql_create_table);

    $db = null;
}    