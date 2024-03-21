<?php //Maxence Persello

function getAllArticles(): array {
    $db = bdConnect();

    $query = "SELECT * FROM article";
    $stmt = $db->query($query);

    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $articles;
}

function getArticle($arID): array {
    $db = bdConnect();

    $query = "SELECT * FROM article WHERE arID = :arID";
    $stmt = $db->prepare($query);
    $stmt->execute(array(':arID' => $arID));
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    return $article;
}

function getComments($arID): array {
    $db = bdConnect();

    $query = "SELECT * FROM commentaire WHERE coArticleID = :arID";
    $stmt = $db->prepare($query);
    $stmt->execute(array(':arID' => $arID));
    $commentaire = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $commentaire;
}