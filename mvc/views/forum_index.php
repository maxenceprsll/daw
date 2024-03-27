<?php // Maxence Persello

echo '<section><h1>Forum</h1></section>';

if (isset($_SESSION['usLogin'])) {
    if (isset($_GET['addArticle'])) {
        echo '<section class="add-forum-form">',
            '<h2>Ajouter un article</h2>',
            '<form action="?route=forum&saveArticle" method="post">',
                '<label for="arTitre">Titre</label>',
                '<input type="text" name="arTitre" placeholder="Titre de l\'article" required><br>',
                '<label for="arContenu">Contenu</label>',
                '<textarea name="arContenu" placeholder="Contenu de l\'article" required></textarea><br>',
                '<input type="submit" value="Publier"/>',
            '</form>',
        '</section>';
    } else {
        echo '<a href="?route=forum&addArticle" class="add-forum-button">Ajouter un article</a>';
    }
}

if (!empty($articles)) {
    foreach ($articles as $article) {
        echo '<section>';
        echo '<h2><a href="?route=forum&arID=' . $article['arID'] . '">' . $article['arTitre'] . '</a></h2>';
        echo '<p>' . $article['arContenu'] . '</p>';
        echo '<p><strong>Auteur:</strong> ' . $article['usNom'] . ' ' . $article['usPrenom'];
        echo ' <strong>Date:</strong> ' . $article['arDate'] . '</p>';
        echo '</section>';
    }
} else {
    echo '<p>Aucun article disponible pour le moment.</p>';
}