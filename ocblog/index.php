<?php
require('controller/frontendController.php');
require('controller/backendController.php');
session_start();


try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'openComment') {
            if (isset($_GET['idc']) && $_GET['idc'] > 0 && isset($_GET['idp']) && $_GET['idp'] > 0) {
                openComment($_GET['idc'], $_GET['idp']);
            }
            else {
                // Autre exception
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
                // Autre exception
                throw new Exception('action inconnue');
            }
        }
        elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['idc']) && $_GET['idc'] > 0 && isset($_GET['idp']) && $_GET['idp'] > 0) {
                reportComment($_GET['idc'], $_GET['idp']);
            }
            else {
                // Autre exception
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
        elseif ($_GET['action'] == 'listAllPostsPagin') {  //recuperer id de article et page
            listPostsPagin();
        }
        
        elseif ($_GET['action'] == 'loginCheck') {  //à améliorer
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
                    // Autre exception
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
                    // Autre exception
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
                    // Autre exception
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
                    // Autre exception
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
                    // Autre exception
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
                    // Autre exception
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
catch(Exception $e) { // S'il y a eu une erreur, alors...  a rajouter une vue
    echo 'Erreur : ' . $e->getMessage();
}

?>
