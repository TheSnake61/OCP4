<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<h1>Ajoutez, éditez ou supprimez des billets :<h1>
<a class="waves-effect waves-light btn-small" href="index.php?action=newPost">Ecrire un article</a>
<div class="divider"></div>


<?php
while ($post = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= $post['title'] ?>
            <em class="article-date">le <?= $post['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= substr($post['content'], 0, 600) ?>...
            <br/>
            <a class="waves-effect waves-light btn-small" href="index.php?action=editPost&amp;id=<?= $post['id'] ?>">Modifier</a>
            <a id="deletepost" class="waves-effect waves-light btn-small" href="index.php?action=deletePost&amp;id=<?= $post['id'] ?>">Supprimer</a>
        </p>
    </div>
    <div class="divider"></div>
<?php
}
$posts->closeCursor();
?>

<ul class="pagination">
    <li class="waves-effect waves-light btn-small"><a href="index.php?action=adminListAllPosts&page=1">First</a></li>
    <li class="waves-effect waves-light btn-small <?php if($actualPage <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($actualPage <= 1){ echo '#'; } else { echo "index.php?action=adminListAllPosts&page=".($actualPage - 1); } ?>">Prev</a>
    </li>
    <li class="waves-effect waves-light btn-small <?php if($actualPage >= $totalPages){ echo 'disabled'; } ?>">
        <a href="<?php if($actualPage >= $totalPages){ echo '#'; } else { echo "index.php?action=adminListAllPosts&page=".($actualPage + 1); } ?>">Next</a>
    </li>
    <li class="waves-effect waves-light btn-small"><a href="index.php?action=adminListAllPosts&page=<?php echo $totalPages; ?>">Last</a></li>
</ul>

<?php $content = ob_get_clean(); ?>

<?php require('view/backend/backTemplate.php'); ?>