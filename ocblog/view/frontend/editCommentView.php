<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p><a href="index.php?action=post&id=<?= $postId ?>">Retour au billet</a></p>


<h2>Modifier votre commentaire</h2>

<form action="index.php?action=editComment&amp;idc=<?= $comment['id'] ?>&amp;idp=<?= $postId ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" value="<?= $comment['author'] ?>" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?= $comment['comment'] ?></textarea>
    </div>
    <div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
            <i class="material-icons right">send</i>
        </button>
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>