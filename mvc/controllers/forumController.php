<?php // Maxence Persello

require_once 'models/forumModel.php';

function forumController(): void {
    head('Forum');
    heading();

    nav();

    if (isset($_GET['arID'])) {

        if (isset($_GET['saveComment'])) {
            $auteur = $_SESSION['usPrenom'].' '.$_SESSION['usNom'];
            addComment($_POST['coArticleID'],$_POST['coContenu'],$auteur);
        }

        $article = getArticle($_GET['arID']);
        $comments = getComments($_GET['arID']);

        include_once 'views/forum_article.php';
    } else {
        
        if (isset($_GET['saveArticle'])) {
            $auteur = $_SESSION['usPrenom'].' '.$_SESSION['usNom'];
            addArticle($_POST['arTitre'],$_POST['arContenu'],$auteur);
        }

        $articles = getAllArticles();
        include_once 'views/forum_index.php';

    }
    footer();
}