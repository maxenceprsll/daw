<?php //Maxence Persello

session_start();
ini_set('display_errors', '1');


require_once 'bibli_ploodle.php';

/*FONCTIONS*/

function bdErreurExit(array $err):void {
    ob_end_clean(); // Suppression de tout ce qui a pu être déja généré

    echo    '<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8">',
            '<title>Erreur base de données',
            '</head><body><h4>', $err['titre'], '</h4>',
            '<pre><strong>Erreur mysqli</strong> : ',  $err['code'], "\n",
                $err['message'], "\n";
    if (isset($err['autres'])){
        echo "\n";
        foreach($err['autres'] as $cle => $valeur){
            echo    '<strong>', $cle, '</strong> :', "\n", $valeur, "\n";
        }
    }
    echo    "\n",'<strong>Pile des appels de fonctions :</strong>', "\n", $err['appels'],
            '</pre></body></html>';
    exit(1);
}




function bdConnect(): mysqli {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try{
        $conn = mysqli_connect(BD_SERVER, BD_USER, BD_PASS, BD_NAME);
    }
    catch(mysqli_sql_exception $e){
        $err['titre'] = 'Erreur de connexion';
        $err['code'] = $e->getCode();
        // $e->getMessage() est encodée en ISO-8859-1, il faut la convertir en UTF-8
        $err['message'] = mb_convert_encoding($e->getMessage(), 'UTF-8', 'ISO-8859-1');
        $err['appels'] = $e->getTraceAsString(); //Pile d'appels
        $err['autres'] = array('Paramètres' =>   'BD_SERVER : '. BD_SERVER
                                                    ."\n".'BD_USER : '. BD_USER
                                                    ."\n".'BD_PASS : '. BD_PASS
                                                    ."\n".'BD_NAME : '. BD_NAME);
        bdErreurExit($err); // ==> ARRET DU SCRIPT
    }
    try{
        //mysqli_set_charset() définit le jeu de caractères par défaut à utiliser lors de l'envoi
        //de données depuis et vers le serveur de base de données.
        mysqli_set_charset($conn, 'utf8');
        return $conn;     // ===> Sortie connexion OK
    }
    catch(mysqli_sql_exception $e){
        $err['titre'] = 'Erreur lors de la définition du charset';
        $err['code'] = $e->getCode();
        $err['message'] = mb_convert_encoding($e->getMessage(), 'UTF-8', 'ISO-8859-1');
        $err['appels'] = $e->getTraceAsString();
        bdErreurExit($err); // ==> ARRET DU SCRIPT
    }
}




function bdSendRequest(mysqli $bd, string $sql): mysqli_result|bool {
    try{
        return mysqli_query($bd, $sql);
    }
    catch(mysqli_sql_exception $e){
        $err['titre'] = 'Erreur de requête';
        $err['code'] = $e->getCode();
        $err['message'] = $e->getMessage();
        $err['appels'] = $e->getTraceAsString();
        $err['autres'] = array('Requête' => $sql);
        bdErreurExit($err);    // ==> ARRET DU SCRIPT
    }
}

function encode_json(mysqli_result $result): string {
    $json_resultat = array();
    while($row = mysqli_fetch_assoc($result)) {
        $json_row = json_encode($row);
        $json_resultat[] = $json_row;
    }
    return json_encode($json_resultat);
}