<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<button name='backtob' onClick='javascript:history.back();' class="waves-effect waves-light btn-small">Retour à la liste des billets</button>




<div class="news">
    <h3>
        <?= $post['title'] ?>
        <em class="article-date">le <?= $post['creation_date_fr'] ?></em>
    </h3>
        
    <p>
        <?= nl2br($post['content']) ?>
    </p>
</div>
<div class="divider"></div>


<h2>Commentaires</h2>

<div class="divider"></div>

<div class=comments>
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
<div class="divider"></div>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?><a class="cmbtn waves-effect waves-light btn-small" href="index.php?action=reportComment&amp;idc=<?= $comment['id'] ?>&amp;idp=<?= $post['id'] ?>">signaler</a></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <div class="divider"></div>
    
<?php
}
$comments->closeCursor();
?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>