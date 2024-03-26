<?php //Maxence Persello & Alexis

function getAllPages($numPages): array {
    $db = bdConnect();

    $query = "SELECT * FROM elementCours WHERE elCoursID = :n";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':n', $numPages);
    $stmt->execute();
    $article = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $article;
}


function save($categorie, $niveau, $titre, $type, $val, $format) {
    $db = bdConnect();

    $sql = "INSERT INTO pageCours(paCategorieID, paTitre, paNiveau) VALUES (:C, :T, :N)";
    $req = $db->prepare($sql);
    $req->bindParam(':C', $categorie);
    $req->bindParam(':T', $titre);
    $req->bindParam(':N', $niveau);
    $req->execute();

    $id = $db->lastInsertId();

    foreach ($type as $key => $t) {
        addElem($db, $id, $t, $val[$key], $format[$key]);
    }

    $db = null;
}


function addElem($id,$type,$val,$format) {
    $db = bdConnect();

    $sql = "INSERT INTO elementCours(elCoursID, elType, elContenu, elFormat) VALUES (:I, :T, :C, :F)";
    $req = $db->prepare($sql);
    $req->bindParam(':I', $id);
    $req->bindParam(':T', $type);
    $req->bindParam(':C', $val);
    $req->bindParam(':F', $format);

    $result = $req->execute();

    $db = null;

    return $result;
}

function getlstCours() {
    $db = bdConnect();

    $sql = "SELECT * FROM pageCours";
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