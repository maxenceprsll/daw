<?php //Maxence Persello

require_once '../php/bibli_generale.php';

if (!isset($_GET["categorie"])) {
    echo "Veuillez renseigner une catégorie";
    return;
}

$db = bdConnect();

$query = "SELECT * FROM question WHERE quCategorie = :categorie";
$stmt = $db->prepare($query);
$stmt->bindParam(':categorie', $_GET['categorie'], PDO::PARAM_INT);
$stmt->execute();

if ($stmt && $stmt->rowCount() > 0) {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo encode_json($result);
} else {
    echo "Valeur introuvable en base de données";
}

$db = null;
