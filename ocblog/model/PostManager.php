<?php
class PostManager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC');

        return $req;
    }

    public function getNumberOfPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) FROM posts');
        $numberOfPosts = $req->fetchColumn();
        return $numberOfPosts;
    }

    public function getPostsPagin($firstPost, $postsPerPage) 
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT ?, ?');
        
        $req->bindParam(1,$firstPost, PDO::PARAM_INT);
        $req->bindParam(2,$postsPerPage, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }


    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }


    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=ocp4;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}