<?php
require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }


    public function getComment($commentId) //recuperer un commentaire pour pouvoir le modifier
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($commentId));

        $comment = $req->fetch();

        return $comment;
    }

    public function editComment($commentId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET author = ?, comment = ? WHERE id = ?');
        $affectedLines = $comments->execute(array($author, $comment, $commentId));

        return $affectedLines;
    }

    public function reportComment($commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET report_status = 2 WHERE id = ?');
        $affectedLines = $comments->execute(array($commentId));

        return $affectedLines;
        
    }

    public function getAllComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY comment_date DESC');

        return $req;
    }

    //admin functions

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



}