<?php //Maxence Persello

require_once '../php/bibli_generale.php';

$db = bdConnect();

$query = "SELECT * FROM question";
$stmt = $db->query($query);

if ($stmt && $stmt->rowCount() > 0) {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo encode_json($result);
} else {
    echo "Valeur introuvable en base de données";
}
