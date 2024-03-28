<?php // Maxence Persello

function getAllArticles(): array {
    $db = bdConnect();

    $query = "SELECT arID, arTitre, arContenu, usNom, usPrenom, arDate FROM article, user WHERE arAuteur = usID ORDER BY (arID) DESC";
    $stmt = $db->query($query);

    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $articles;
}

function getArticle($arID): array {
    $db = bdConnect();

    $query = "SELECT arID, arTitre, arContenu, usNom, usPrenom, arDate FROM article, user WHERE arID = :arID AND arAuteur = usID";
    $stmt = $db->prepare($query);
    $stmt->execute(array(':arID' => $arID));
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    $db = null;

    return $article;
}

function getComments($arID): array {
    $db = bdConnect();

    $query = "SELECT * FROM commentaire, user WHERE coArticleID = :arID AND coAuteur = usID ORDER BY (coID)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':arID', $arID);
    
    $stmt->execute();
    $commentaire = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $commentaire;
}

function addArticle($arTitre, $arContenu, $arAuteur): void {
    $db = bdConnect();

    $query = "INSERT INTO article (arTitre, arContenu, arAuteur, arDate) VALUES (:arTitre, :arContenu, :arAuteur, NOW())";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':arContenu', $arContenu);
    $stmt->bindParam(':arAuteur', $arAuteur);

    $stmt->execute();

    $db = null;
}

function addComment($coArticleID, $coContenu, $coAuteur): void {
    $db = bdConnect();

    $query = "INSERT INTO commentaire (coArticleID, coContenu, coAuteur, coDate) VALUES (:coArticleID, :coContenu, :coAuteur, NOW())";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':coArticleID', $coArticleID);
    $stmt->bindParam(':coContenu', $coContenu);
    $stmt->bindParam(':coAuteur', $coAuteur);

    $stmt->execute();

    $db = null;
}