<?php // Maxence Persello

include_once '../php/bibli_generale.php';

$db = bdConnect();

$input =isset($_POST['input'])?'%'.$_POST['input'].'%':'';

if($input) {
    $query = "SELECT paID, paTitre, foIntitule, niIntitule, niShort, usNom, usPrenom FROM pageCours, formation, niveau, user WHERE paUser = usID AND paFormationID = foID AND paNiveau = niID AND (usNom LIKE :nom OR usPrenom LIKE :prenom OR paTitre LIKE :titre OR niShort LIKE :niveau OR foIntitule LIKE :formation)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nom', $input);
    $stmt->bindParam(':prenom', $input);
    $stmt->bindParam(':titre', $input);
    $stmt->bindParam(':niveau', $input);
    $stmt->bindParam(':formation', $input);
} else {
    $query = "SELECT paID, paTitre, foIntitule, niIntitule, niShort, usNom, usPrenom FROM pageCours, formation, niveau, user WHERE paUser = usID AND paFormationID = foID AND paNiveau = niID";
    $stmt = $db->prepare($query);
}

$stmt->execute();

$cours = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($cours)) {
    echo '<tr>',
        '<th>Nom du cours</th>',
        '<th>Auteur</th>',
        '<th>Formation</th>',
        '<th>Niveau</th>',
        '<th>Actions</th>';

    foreach ($cours as $cour) {   
        echo '<tr>',
            '<td>'.$cour['paTitre'].'</td>',
            '<td>'.$cour['usNom'].' '.$cour['usPrenom'].'</td>',
            '<td>'.$cour['foIntitule'].'</td>',
            '<td>'.$cour['niShort'].'</td>',
            '<td><a href="?route=cours&page='.$cour['paID'].'">Consulter</a>';
            if (isset($_SESSION['usAdmin']) && $_SESSION['usAdmin']) {
                echo '<a href="?route=remove_page&id='. $cour['paID'] .'">Supprimer</a></td>';
            }
        echo '</tr>';
    }

} else {
    echo '<p>Aucun cours ne correspond à la recherche</p>';
}

