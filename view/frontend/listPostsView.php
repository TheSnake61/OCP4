<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p class="titledesc">Un roman de Jean Forteroche</p>
<div class="divider"></div>
<p>Derniers chapitres :</p>


<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= $data['title'] ?>
            <em class="article-date">le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= substr($data['content'], 0, 600) ?>...
            <br />
            <em><a class="waves-effect waves-light btn-small" href="index.php?action=post&id=<?= $data['id'] ?>">Lire la suite</a></em>
        </p>
    </div>
    <div class="divider"></div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>