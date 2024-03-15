<?php
if (isset($_GET["idQuestion"])) {
    $id = $_GET['idQuestion'];

    $db = new PDO("mysql:host=localhost;dbname=projetdaw", "admin", "admin");

    $requete = $db->prepare('SELECT * from question INNER JOIN reponse on question.idQuestion = reponse.idQuestion where question.idQuestion= :idQues ');
    $requete->bindParam(':idQues', $id);
    $requete->execute();
    $res = $requete->fetchAll();

    $count = $requete->rowcount();
    //verification que les installations sont déjà en bdd
    if ($count) {
        echo json_encode($res);
    }else{
        echo "Valeur introuvable en base de données";
    }
}else{
    echo "erreur de paramètre";
}
?>