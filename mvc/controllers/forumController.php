<?php // Maxence Persello

require_once 'models/forumModel.php';

function forumController(): void {
    head('Forum');
    heading();

    nav();

    if (isset($_GET['arID'])) {

        $article = getArticle($_GET['arID']);
        
        echo '<div class="article">';
        echo '<h2>' . $article['arTitre'] . '</h2>';
        echo '<p>' . $article['arContenu'] . '</p>';
        echo '<p><strong>Auteur:</strong> ' . $article['arAuteur'];
        echo ' <strong>Date:</strong> ' . $article['arDate'] . '</p>';
        echo '</div>';

        $comments = getComments($_GET['arID']);

        if (!empty($comments)) {
            echo '<div class="comments">';
            foreach ($comments as $comment) {
                echo '<div class="comment">';
                echo '<p>' . $comment['coContenu'] . '</p>';
                echo '<p><strong>Auteur:</strong> ' . $comment['coAuteur'];
                echo ' <strong>Date:</strong> ' . $comment['coDate'] . '</p>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>Aucun commentaire pour cet article.</p>';
        }

        echo '<a href="?route=add_comment&arID=' . $_GET['arID'] . '" class="add-comment-button">Ajouter un commentaire</a>';
    } else {
        $articles = getAllArticles();

        if (!empty($articles)) {
            foreach ($articles as $article) {
                echo '<div class="article">';
                echo '<h2><a href="?route=forum&arID=' . $article['arID'] . '">' . $article['arTitre'] . '</a></h2>'; // Ajoutez un lien autour du titre de l'article
                echo '<p>' . $article['arContenu'] . '</p>';
                echo '<p><strong>Auteur:</strong> ' . $article['arAuteur'];
                echo ' <strong>Date:</strong> ' . $article['arDate'] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucun article disponible pour le moment.</p>';
        }

    }
    footer();
}