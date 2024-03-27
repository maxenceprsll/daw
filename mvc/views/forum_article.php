<?php // Maxence Persello

echo '<section>',
    '<h2>' . $article['arTitre'] . '</h2>',
    '<p>' . $article['arContenu'] . '</p>',
    '<p><strong>Auteur:</strong> ' . $article['usNom'] . ' ' . $article['usPrenom'],
    ' <strong>Date:</strong> ' . $article['arDate'] . '</p>',
'</section>';

if (!empty($comments)) {
    echo '<div class="comments">';
    foreach ($comments as $comment) {
        echo '<section class="comment">',
            '<p>' . $comment['coContenu'] . '</p>',
            '<p><strong>Auteur:</strong> ' . $comment['usNom'] . ' ' . $comment['usPrenom'],
            ' <strong>Date:</strong> ' . $comment['coDate'] . '</p>',
        '</section>';
    }
    echo '</div>';
} else {
    echo '<p>Aucun commentaire pour cet article.</p>';
}

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