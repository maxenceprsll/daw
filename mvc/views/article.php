<?php //Maxence Persello

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

echo '<a href="?route=add_comment&arID=' . $_GET['arID'] . '" class="add-forum-button">Ajouter un commentaire</a>';