<?php
class AdminPostManager
{
    
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

    public function getPost($id) //recuperer un commentaire pour pouvoir le modifier
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM posts WHERE id = ?');
        $req->execute(array($id));

        $post = $req->fetch();

        return $post;
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