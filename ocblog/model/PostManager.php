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

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('DELETE FROM posts WHERE id = ?');
        $posts->execute(array($id));
        $comments = $db->prepare('DELETE FROM comments WHERE post_id = ?');
        $comments->execute(array($id));
    }

    public function postNewPost($title, $content)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
        $affectedLines = $posts->execute(array($title, $content));

        return $affectedLines;
    }

    public function savePostEdit($id, $title, $content)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $affectedLines = $posts->execute(array($title, $content, $id));

        return $affectedLines;
    }


    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=ocp4;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}