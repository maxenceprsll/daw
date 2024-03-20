<?php //Maxence Persello & Johann

require_once '../php/bibli_generale.php';

$db = bdConnect();

$requete = "SELECT * FROM question";
$result = bdSendRequest($db, $requete);

if ($result && mysqli_num_rows($result) > 0) {
    echo encode_json($result);
} else {
    echo "Valeur introuvable en base de données";
}

mysqli_close($db);