<?php if (count($comments)>0) : ?>
    <div class="alert alert-info"><?= count($comments); ?> commentaires en attentes de validation</div>
<?php endif; ?>

<h1>Gestion du blog</h1>
<a href="index.php?p=admin.post.index" class="btn btn-primary">Articles</a>
<a href="index.php?p=admin.category.index" class="btn btn-primary">Categories</a>
<a href="index.php?p=admin.comment.index" class="btn btn-primary">Commentaires</a>
