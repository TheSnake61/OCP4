<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function unknownAction()
{
    require('view/frontend/unknownActionView.php');
}

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function listAllPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getAllPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/allPostsView.php');
}

function listPostsPagin() 
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getNumberOfPosts(); // Appel d'une fonction de cet objet
    $postsPerPage = 5;
    $totalPages = ceil($posts / $postsPerPage);
    if (!isset($_GET['page']) || $_GET['page'] < 1 ) {
        $actualPage = 1;
    }
    else {
        $actualPage = $_GET['page'];
    }
    
    $firstPost = ($actualPage - 1) * $postsPerPage;
    $posts = $postManager->getPostsPagin($firstPost, $postsPerPage);

    if ($actualPage <= $totalPages) {
        require('view/frontend/allPostsViewPagin.php');
    }
    else {
        require('view/frontend/noPostView.php');
    }
    

    
    
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    if (($post['content']) == "") { // ou avec un booleen
        require('view/frontend/noPostView.php');
    }
    else {
        require('view/frontend/postView.php');
    }
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function openComment($commentId, $postId)
{
    $commentManager = new CommentManager();

    $comment = $commentManager->getComment($_GET['idc']);

    require('view/frontend/editCommentView.php');

}

function editComment($postId, $commentId, $comment, $author)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->editComment($commentId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }

}

function reportComment($commentId, $postId)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->reportComment($commentId);

    if ($affectedLines === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }

}

function login()
{
    require('view/frontend/loginView.php');
}




