<?php //Maxence Persello & Johann

require_once '../php/bibli_generale.php';

if(isset($_GET['quID'])){
    $id = $_GET['quID'];

    $db = bdConnect();

    $requete = "SELECT * from reponse WHERE reQuestionID=".$id;
    $result = bdSendRequest($db, $requete);

    if ($result && mysqli_num_rows($result) > 0) {
        echo encode_json($result);
    } else {
        echo json_encode(["error" => "No answers found for the question with ID: $id"]);
    }
} else {
    echo json_encode(["error" => "Missing parameter: quID"]);
}

mysqli_close($db);