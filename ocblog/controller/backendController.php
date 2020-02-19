<?php

// Chargement des classes
require_once('model/LoginManager.php');
require_once('model/PostManager.php');
require_once('model/AdminPostManager.php');
require_once('model/AdminCommentManager.php');

function loginCheck($user, $pass)
{
    $loginManager = new LoginManager(); // Création d'un objet
    $users = $loginManager->loginCheck($user, $pass); // Appel d'une fonction de cet objet
}


function adminListAllPosts() 
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
        require('view/backend/backPostsView.php');
    }
    else {
        require('view/frontend/noPostView.php');
    }
    

    
    
}


function adminListAllComments()
{
    $adminCommentManager = new AdminCommentManager(); // Création d'un objet
    $comments = $adminCommentManager->getAllComments(); // Appel d'une fonction de cet objet

    require('view/backend/backCommentView.php');
}

function adminListReportedComments()
{
    $adminCommentManager = new AdminCommentManager(); // Création d'un objet
    $comments = $adminCommentManager->getReportedComments(); // Appel d'une fonction de cet objet

    require('view/backend/backCommentView.php');
}

function deleteComment($id)
{
    $adminCommentManager = new AdminCommentManager(); // Création d'un objet
    $comments = $adminCommentManager->deleteComment($_GET['id']); // Appel d'une fonction de cet objet
    header ('Location: index.php?action=adminListAllComments');
}

function unreportComment($id)
{
    $adminCommentManager = new AdminCommentManager(); // Création d'un objet
    $comments = $adminCommentManager->unreportComment($_GET['id']); // Appel d'une fonction de cet objet
    header ('Location: index.php?action=adminListAllComments');
}



function newPost()
{
    require('view/backend/backNewPostView.php');
}

function postNewPost($title, $content)
{
    $adminPostManager = new AdminPostManager();

    $affectedLines = $adminPostManager->postNewPost($title, $content);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter l\'article !');
    }
    else {
        header('Location: index.php?action=adminListAllPosts&page=1');
    }
}

function deletePost($id)
{
    $adminPostManager = new AdminPostManager(); // Création d'un objet
    $posts = $adminPostManager->deletePost($_GET['id']); // Appel d'une fonction de cet objet
    header ('Location: index.php?action=adminListAllPosts&page=1');
}

function editPost($id)
{
    $adminPostManager = new AdminPostManager();

    $post = $adminPostManager->getPost($_GET['id']);

    require('view/backend/backEditPostView.php');

}

function savePostEdit($id, $title, $content)
{
    $adminPostManager = new AdminPostManager();

    $affectedLines = $adminPostManager->savePostEdit($id, $title, $content);

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=adminListAllPosts');
    }

}

