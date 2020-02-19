<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<h2>Commentaires signalés</h2>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?><a class="waves-effect waves-light btn-small" href="index.php?action=deleteComment&amp;id=<?= $comment['id'] ?>">supprimer</a><a class="waves-effect waves-light btn-small" href="index.php?action=unreportComment&amp;id=<?= $comment['id'] ?>">retirer le signalement</a></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    
<?php
}
$comments->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('view/backend/backTemplate.php'); ?>