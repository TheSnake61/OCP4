<?php
require('controller/frontendController.php');
require('controller/backendController.php');
session_start();


try { 
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'openComment') {
            if (isset($_GET['idc']) && $_GET['idc'] > 0 && isset($_GET['idp']) && $_GET['idp'] > 0) {
                openComment($_GET['idc'], $_GET['idp']);
            }
            else {
                throw new Exception('action inconnue');
            }
        }
        elseif ($_GET['action'] == 'editComment') {
            if (isset($_GET['idc']) && $_GET['idc'] > 0 && isset($_GET['idp']) && $_GET['idp'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    editComment($_GET['idp'], $_GET['idc'],  $_POST['comment'], $_POST['author']);
                }
            }
            else {
                throw new Exception('action inconnue');
            }
        }
        elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['idc']) && $_GET['idc'] > 0 && isset($_GET['idp']) && $_GET['idp'] > 0) {
                reportComment($_GET['idc'], $_GET['idp']);
            }
            else {
                throw new Exception('action inconnue');
            }
        }
        elseif ($_GET['action'] == 'login') {
            if (isset($_SESSION['user']) && ($_SESSION['user'] == "admin") ) {
                header ('Location: index.php?action=adminListAllPosts&page=1');
            }
            else {
                login();
            }
        }
        elseif ($_GET['action'] == 'listAllPosts') {
            listAllPosts();
        }
        elseif ($_GET['action'] == 'listAllPostsPagin') {  
            listPostsPagin();
        }
        
        elseif ($_GET['action'] == 'loginCheck') {  
            if (isset($_POST['pseudo']) && isset($_POST['pass'])) {
                loginCheck($_POST['pseudo'], $_POST['pass']);
            }
            else {
                throw new Exception('mot de passe et/ou pseudo manquant');
            }
        }
        elseif ($_GET['action'] == 'adminListAllPosts') {
            if (isset($_SESSION['user']) && ($_SESSION['user'] == "admin") ) {
                
                adminListAllPosts();
            }
            else {
                header ('Location: index.php?action=login');
            }
        }
        elseif ($_GET['action'] == 'adminListAllComments') {
            if (isset($_SESSION['user']) && ($_SESSION['user'] == "admin") ) {
                adminListReportedComments();
            }
            else {
                header ('Location: index.php?action=login');
            }
        }
        elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_SESSION['user']) && ($_SESSION['user'] == "admin") ) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    deleteComment($_GET['id']);
                }
                else {
                    throw new Exception('action inconnue');
                }
            }
            else {
                header ('Location: index.php?action=login');
            }
        }
        elseif ($_GET['action'] == 'unreportComment') {
            if (isset($_SESSION['user']) && ($_SESSION['user'] == "admin") ) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    unreportComment($_GET['id']);
                }
                else {
                    throw new Exception('action inconnue');
                }
            }
            else {
                header ('Location: index.php?action=login');
            }
        }
        elseif ($_GET['action'] == 'postNewPost') {
            if (isset($_SESSION['user']) && ($_SESSION['user'] == "admin") ) {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    postNewPost($_POST['title'], $_POST['content']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                header ('Location: index.php?action=login');
            }
        }
        
        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_SESSION['user']) && ($_SESSION['user'] == "admin") ) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    deletePost($_GET['id']);
                }
                else {
                    throw new Exception('action inconnue');
                }
            }
            else {
                header ('Location: index.php?action=login');
            }
        }
        elseif ($_GET['action'] == 'newPost') {  
            if (isset($_SESSION['user']) && ($_SESSION['user'] == "admin") ) { 
                newPost();
            }
            else {
                header ('Location: index.php?action=login');
            }
        }
        elseif ($_GET['action'] == 'editPost') {
            if (isset($_SESSION['user']) && ($_SESSION['user'] == "admin") ) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                
                    editPost($_GET['id']);
            
                }
                else {
                    throw new Exception('action inconnue');
                }
            }
            else {
                header ('Location: index.php?action=login');
            }
        }
        elseif ($_GET['action'] == 'savePostEdit') {
            if (isset($_SESSION['user']) && ($_SESSION['user'] == "admin") ) {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        savePostEdit($_GET['id'], $_POST['title'], $_POST['content']);
                    }
                }
                else {
                    throw new Exception('action inconnue');
                }
            }
            else {
                header ('Location: index.php?action=login');
            }
        }
        elseif ($_GET['action'] == 'logout') {
            $_SESSION = array();   
            session_destroy();
            header('Location: index.php');
        }
        else {  //if action doesnt exist
            unknownAction();
        }


    }
    else {
        listPosts();
    }
}
catch(Exception $e) { 
    echo 'Erreur : ' . $e->getMessage();
}

?>
