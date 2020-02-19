<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<p><a href="index.php?action=adminListAllPosts&page=1">Retour aux billets</a></p>


<h2>Modifier votre chapitre</h2>

<form action="index.php?action=savePostEdit&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="<?= $post['title'] ?>" />
    </div>
    <div>
        <label for="content">Article</label><br />
        <textarea id="content" name="content"><?= $post['content'] ?></textarea>
    </div>
    <div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
            <i class="material-icons right">send</i>
        </button>
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('view/backend/backTemplate.php'); ?>