<?php //Maxence Persello

require_once 'bibli_generale.php';

head('Inscription');
nav();

if (isset($_POST['btnInscription'])) {
    traitementInscription();
}
aff_inscription();

footer();

/*FONCTIONS*/

function aff_inscription():void {

    if (isset($_SESSION['usAdmin']) && $_SESSION['usAdmin']) {
    } else {
        header('location: ../index.php');
        exit;
    }

    $post = ['login' => '', 'nom' => '', 'prenom' =>''];

    if (isset($_POST['btnInscription'])) {
        $post = $_POST;
    }

    echo
    '<section class="sessionForm"><h3>Ajout d\'un utilisateur</h3>',
    '<p>Merci de fournir les informations suivantes.</p>',
    '<form action="inscription.php" method="POST">',
        '<ul>',
            '<li><label for="login">Login</label></li>',
            '<li><input id="login" name="login" type="text" placeholder="4 à 8 lettres minuscules ou chiffres" required value="', $post['login'], '"/></li>',
            '<li><label for="password">Mot de passe</label></li>',
            '<li><input id="password" name="password" type="password" placeholder="4 caractères minimum" required/></li>',
            '<li><label for="nom">Nom</label></li>',
            '<li><input id="nom" name="nom" type="text" required value="', $post['nom'], '"></input></liu>',
            '<li><label for="prenom">Prénom</label></li>',
            '<li><input id="prenom" name="prenom" type="text" required value="', $post['prenom'], '"/></li>',
            '<li id="btnAdmin">',
            '<input id="admin" name=admin type="checkbox" value="1">',
            '<label for="admin">Statut Administrateur</label></li>',
            '<li><input type="submit" name="btnInscription" value="S\'inscrire"></li>',
        '</ul>',
    '</form>',
    '</section>';
}


function traitementInscription():void {
    $passe = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $bd = bdConnect();
    $admin = isset($_POST['admin'])?$_POST['admin']:'0';
	$sql = "INSERT INTO user (usNom, usPrenom, usLogin, usPass, usAdmin) VALUES ('" 
        . $_POST['nom']
		. "','" . $_POST['prenom']
		. "','" . $_POST['login']
		. "','" . $passe
        . "','" . $admin
        . "')";
	bdSendRequest($bd, $sql);
	mysqli_close($bd);

	echo '<section>',
	'<p>Un nouvel usager a bien été enregistré.</p>',
	'</section>';

}