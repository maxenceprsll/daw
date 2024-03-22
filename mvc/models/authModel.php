<?php //Maxence Persello

function traitementConnexion(): bool {
    if (isset($_POST['login'], $_POST['password'])) {

        $login = $_POST['login'];
        $passe = $_POST['password'];

        $db = bdConnect();

        $query = "SELECT * FROM user WHERE usLogin=:login";
        $stmt = $db->prepare($query);
        $stmt->execute(array(':login' => $login));
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        $db = null;

        if ($userData && password_verify($passe, $userData['usPass'])) {
            extract($userData);
            $_SESSION['usLogin'] = $usLogin;
            $_SESSION['usID'] = $usID;
            $_SESSION['usNom'] = $usNom;
            $_SESSION['usPrenom'] = $usPrenom;
            $_SESSION['usAdmin'] = $usAdmin;
            return true;
        } else {
            return false;
        }
    }
    return false;
}