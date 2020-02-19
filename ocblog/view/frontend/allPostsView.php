<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p>Tout les billets :</p>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= $data['title'] ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= ($data['content']) ?>
            <br />
            <em><a class="waves-effect waves-light btn-small" href="index.php?action=post&id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>