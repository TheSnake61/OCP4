<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p><a class="waves-effect waves-light btn-small" href="index.php">Retour à la liste des billets</a></p>




<div class="news">
    <h3>
        <?= $post['title'] ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
        
    <p>
        <?= nl2br($post['content']) ?>
    </p>
</div>


<h2>Commentaires</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div> 
        <button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
            <i class="material-icons right">send</i>
        </button>
    </div>
</form>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?><a class="waves-effect waves-light btn-small" href="index.php?action=openComment&amp;idc=<?= $comment['id'] ?>&amp;idp=<?= $post['id'] ?>">modifier</a><a class="waves-effect waves-light btn-small" href="index.php?action=reportComment&amp;idc=<?= $comment['id'] ?>&amp;idp=<?= $post['id'] ?>">signaler</a></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    
<?php
}
$comments->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>