<?php


require_once('model/LoginManager.php');
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function loginCheck($user, $pass)
{
    $loginManager = new LoginManager(); 
    $users = $loginManager->loginCheck($user, $pass); 
}


function adminListAllPosts() 
{
    $postManager = new PostManager(); 
    $posts = $postManager->getNumberOfPosts(); 
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
    $CommentManager = new CommentManager(); 
    $comments = $CommentManager->getAllComments(); 

    require('view/backend/backCommentView.php');
}

function adminListReportedComments()
{
    $CommentManager = new CommentManager(); 
    $comments = $CommentManager->getReportedComments(); 

    require('view/backend/backCommentView.php');
}

function deleteComment($id)
{
    $CommentManager = new CommentManager(); 
    $comments = $CommentManager->deleteComment($_GET['id']); 
    header ('Location: index.php?action=adminListAllComments');
}

function unreportComment($id)
{
    $CommentManager = new CommentManager(); 
    $comments = $CommentManager->unreportComment($_GET['id']); 
    header ('Location: index.php?action=adminListAllComments');
}



function newPost()
{
    require('view/backend/backNewPostView.php');
}

function postNewPost($title, $content)
{
    $PostManager = new PostManager();

    $affectedLines = $PostManager->postNewPost($title, $content);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter l\'article !');
    }
    else {
        header('Location: index.php?action=adminListAllPosts&page=1');
    }
}

function deletePost($id)
{
    $PostManager = new PostManager(); 
    $posts = $PostManager->deletePost($_GET['id']); 
    header ('Location: index.php?action=adminListAllPosts&page=1');
}

function editPost($id)
{
    $PostManager = new PostManager();

    $post = $PostManager->getPost($_GET['id']);

    require('view/backend/backEditPostView.php');

}

function savePostEdit($id, $title, $content)
{
    $PostManager = new PostManager();

    $affectedLines = $PostManager->savePostEdit($id, $title, $content);

    if ($affectedLines === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?action=adminListAllPosts');
    }

}

