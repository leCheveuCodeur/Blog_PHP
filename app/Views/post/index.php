<div class="blog">

    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Le Blog</h1>

        <nav class="nav justify-content-center">
            <?php foreach ($categories as $category) : ?>
                <a class="nav-link" href="<?= $category->url; ?>"><?= $category->title; ?></a>
            <?php endforeach; ?>
        </nav>
    </div>

    <?php include("posts.php"); ?>

    <?= $paging; ?>

</div>
