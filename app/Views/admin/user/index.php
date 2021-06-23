<div class="admin container-xxl">
    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Gestion du blog</h1>
    </div>
    <div>
        <div class="admin_panel">
            <?php if (count($comments) > 0) : ?>
                <div class="alert alert-info text-center"><?= count($comments); ?> commentaire<?= count($comments) > 1 ? 's' : ''; ?> en attente<?= count($comments) > 1 ? 's' : ''; ?> de validation</div>
            <?php endif; ?>
            <div class="admin_panel_btn">
                <a href="index.php?p=admin.post.index" class="btn btn-lg btn-primary">Articles</a>
                <a href="index.php?p=admin.category.index" class="btn btn-lg btn-primary">Categories</a>
                <a href="index.php?p=admin.comment.index" class="btn btn-lg btn-primary">Commentaires</a>
            </div>
        </div>
    </div>
</div>
