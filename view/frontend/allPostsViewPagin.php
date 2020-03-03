






<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p class= "titledesc">Un roman de Jean Forteroche</p>
<div class="divider"></div>
<p>Tout les chapitres :</p>



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


<ul class="pagination">
    <li class="waves-effect waves-light btn-small" id="fst"><a href="index.php?action=listAllPostsPagin&page=1">First</a></li>
    <li class="waves-effect waves-light btn-small <?php if($actualPage <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($actualPage <= 1){ echo '#'; } else { echo "index.php?action=listAllPostsPagin&page=".($actualPage - 1); } ?>">Prev</a>
    </li>
    <li class="waves-effect waves-light btn-small <?php if($actualPage >= $totalPages){ echo 'disabled'; } ?>">
        <a href="<?php if($actualPage >= $totalPages){ echo '#'; } else { echo "index.php?action=listAllPostsPagin&page=".($actualPage + 1); } ?>">Next</a>
    </li>
    <li class="waves-effect waves-light btn-small" id="lst"><a href="index.php?action=listAllPostsPagin&page=<?php echo $totalPages; ?>">Last</a></li>
</ul>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

