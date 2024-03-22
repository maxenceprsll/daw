<?php //Maxence Persello

if (isset($_SESSION['usLogin'])) {
    if (isset($_GET['addComment'])) {
        echo '<section class="add-forum-form">',
            '<h2>Ajouter un commentaire</h2>',
            '<form action="?route=forum&arID='.$_GET['arID'].'&saveComment" method="post">',
                '<label for="coContenu">Message</label>',
                '<textarea name="coContenu" placeholder="Contenu du commentaire" required></textarea><br>',
                '<input type="hidden" name="coArticleID" value="'.$_GET['arID'].'">',
                '<input type="submit" value="Publier"/>',
            '</form>',
        '</section>';
    } else {
        echo '<a href="?route=forum&arID='.$_GET['arID'].'&addComment" class="add-forum-button">Ajouter un commentaire</a>';
    }
}

echo '<section>';
echo '<h2>' . $article['arTitre'] . '</h2>';
echo '<p>' . $article['arContenu'] . '</p>';
echo '<p><strong>Auteur:</strong> ' . $article['arAuteur'];
echo ' <strong>Date:</strong> ' . $article['arDate'] . '</p>';
echo '</section>';

if (!empty($comments)) {
    echo '<div class="comments">';
    foreach ($comments as $comment) {
        echo '<section class="comment">';
        echo '<p>' . $comment['coContenu'] . '</p>';
        echo '<p><strong>Auteur:</strong> ' . $comment['coAuteur'];
        echo ' <strong>Date:</strong> ' . $comment['coDate'] . '</p>';
        echo '</section>';
    }
    echo '</div>';
} else {
    echo '<p>Aucun commentaire pour cet article.</p>';
}