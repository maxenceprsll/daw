<?php //Maxence Persello & Johann

require_once '../php/bibli_generale.php';

if(!isset($_GET["categorie"])){
    echo "Veuillez renseigner une catégorie";
    return;
}
$db = bdConnect();

$requete = "SELECT * from question WHERE quCategorie = ".$_GET['categorie'];
$result = bdSendRequest($db, $requete);

if ($result && mysqli_num_rows($result) > 0) {
    echo encode_json($result);
} else {
    echo "Valeur introuvable en base de données";
}

mysqli_close($db);