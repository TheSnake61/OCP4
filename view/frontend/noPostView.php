<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<p>La page que vous demandez n'existe pas !</p>
<p><a class="waves-effect waves-light btn-small" href="index.php">Retour à l'accueil</a></p>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>