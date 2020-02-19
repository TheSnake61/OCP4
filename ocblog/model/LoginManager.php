<?php
class LoginManager
{
    

    public function loginCheck($user, $pass)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT pass FROM users WHERE user = :user');
        $req->execute(array(
            'user' => $user));
        $result = $req->fetch();

        
        $isPasswordCorrect = password_verify($_POST['pass'], $result['pass']);  
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

    

    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=ocp4;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}