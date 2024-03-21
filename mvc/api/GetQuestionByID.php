<?php //Maxence Persello

require_once '../php/bibli_generale.php';

if(isset($_GET['quID'])){
    $id = $_GET['quID'];

    $db = bdConnect();

    $requete = "SELECT * from question WHERE quID = ".$id;
    $result = bdSendRequest($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo encode_json($result);
    }else{
        echo "Valeur introuvable en base de données";
    }
} else {
    echo "Erreur de paramètre";
}

mysqli_close($db);