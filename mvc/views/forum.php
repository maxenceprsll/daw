<?php //Maxence Persello

if (isset($_SESSION['usLogin'])) {
    if (isset($_GET['addArticle'])) {
        echo '<section class="add-article-form">';
        echo '<h2>Ajouter un article</h2>';
        echo '<form action="?route=forum&saveArticle" method="post">';
        echo '<label for="arTitre">Titre</label>';
        echo '<input type="text" name="arTitre" placeholder="Titre de l\'article" required><br>';
        echo '<label for="login">Contenu</label>';
        echo '<textarea name="arContenu" placeholder="Contenu de l\'article" required></textarea><br>';
        echo '<input type="submit" value="Publier">';
        echo '</form>';
        echo '</section>';
    } else {
        echo '<a href="?route=forum&addArticle" class="add-forum-button">Ajouter un article</a>';
    }
}

if (!empty($articles)) {
    foreach ($articles as $article) {
        echo '<section>';
        echo '<h2><a href="?route=forum&arID=' . $article['arID'] . '">' . $article['arTitre'] . '</a></h2>'; // Ajoutez un lien autour du titre de l'article
        echo '<p>' . $article['arContenu'] . '</p>';
        echo '<p><strong>Auteur:</strong> ' . $article['arAuteur'];
        echo ' <strong>Date:</strong> ' . $article['arDate'] . '</p>';
        echo '</section>';
    }
} else {
    echo '<p>Aucun article disponible pour le moment.</p>';
}