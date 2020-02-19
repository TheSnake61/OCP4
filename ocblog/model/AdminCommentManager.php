<?php
class AdminCommentManager  
{
    public function getAllComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY comment_date DESC');

        return $req;
    }

    public function getReportedComments()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE report_status = 2 ORDER BY comment_date DESC');

        return $comments;
    }

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('DELETE FROM comments WHERE id = ?');
        $comments->execute(array($id));
    }

    public function unreportComment($id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET report_status = 1 WHERE id = ?');
        $comments->execute(array($id));
    }

    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=ocp4;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}