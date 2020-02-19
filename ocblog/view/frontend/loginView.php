<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>



<h2>Connectez vous</h2>

<form action="index.php?action=loginCheck" method="post">
    <div>
        <label for="pseudo">Pseudo</label><br />
        <input type="text" id="pseudo" name="pseudo"/>
    </div>
    <div>
        <label for="pass">Mot de passe</label><br />
        <input type="password" id="pass" name="pass"/>
    </div>
    <div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
            <i class="material-icons right">send</i>
        </button>
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>