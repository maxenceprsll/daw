<?php //Maxence Persello

function getAllArticles(): array {
    $db = bdConnect();

    $query = "SELECT * FROM article";
    $stmt = $db->query($query);

    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $articles;
}

function getArticle($arID): array {
    $db = bdConnect();

    $query = "SELECT * FROM article WHERE arID = :arID";
    $stmt = $db->prepare($query);
    $stmt->execute(array(':arID' => $arID));
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    $db = null;

    return $article;
}

function getComments($arID): array {
    $db = bdConnect();

    $query = "SELECT * FROM commentaire WHERE coArticleID = :arID";
    $stmt = $db->prepare($query);
    $stmt->execute(array(':arID' => $arID));
    $commentaire = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $commentaire;
}

function addArticle($arTitre, $arContenu, $arAuteur): void {
    $db = bdConnect();

    $query = "INSERT INTO article (arTitre, arContenu, arAuteur, arDate) VALUES (:arTitre, :arContenu, :arAuteur, NOW())";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':arTitre', $arTitre, PDO::PARAM_STR);
    $stmt->bindParam(':arContenu', $arContenu, PDO::PARAM_STR);
    $stmt->bindParam(':arAuteur', $arAuteur, PDO::PARAM_STR);

    $stmt->execute();

    $db = null;
}
