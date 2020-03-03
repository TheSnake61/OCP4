<?php
require_once('model/Manager.php');

class LoginManager extends Manager
{
    

    public function loginCheck($user, $pass)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT pass FROM users WHERE user = :user');
        $req->execute(array(
            'user' => $user));
        $result = $req->fetch();

        
        $isPasswordCorrect = password_verify($_POST['pass'], $result['pass']);  //comparing pass to encripted one
        if (!$result)
        {
            echo 'Mauvais identifiant ou mot de passe !';
        }
        else
        {
            if ($isPasswordCorrect) {
                $_SESSION['user'] = $user;
                header ('Location:index.php?action=adminListAllPosts&page=1');
            }
            else {
                echo 'Mauvais identifiant ou mot de passe !';
            }
        } 
    }

    


}