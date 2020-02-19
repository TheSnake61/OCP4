<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<h2>Ecrivez un article</h2>

<form action="index.php?action=postNewPost" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="" />
    </div>
    <div>
        <label for="content">Article</label><br />
        <textarea id="content" name="content"></textarea>
    </div>
    <div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
            <i class="material-icons right">send</i>
        </button>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/backend/backTemplate.php'); ?>