<div class="blog">

    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold"><?= $category->title ?></h1>

        <nav class="nav justify-content-center">
            <a class="nav-link" href="?p=post.index">
                <<<< </a>
                    <?php foreach ($categories as $cat) : ?>
                        <?php if ($cat->id != $category_id) : ?>
                            <a class="nav-link" href="<?= $cat->url; ?>"><?= $cat->title; ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
        </nav>
    </div>

    <?php include("posts.php"); ?>

    <?= $paging; ?>

</div>
