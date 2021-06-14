<div class="row">
    <div class="col-sm-8">
        <?php foreach ($posts as $post) : ?>

            <h2><a href="<?= $post->url; ?>"><?= $this->antiXss($post->title); ?></a></h2>
            <p><em><?= $post->category; ?> </em></p>

            <p><?= $post->extrait; ?></p>

        <?php endforeach; ?>

        <?= var_dump($page); ?></br>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item<?= $previous ?>">
                    <a class="page-link" href="?p=post.index.<?= $page - 1; ?>" aria-disabled="<?= !empty($previous) ? 'true' : '' ?>">&laquo;</a>
                </li>
                <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?p=post.index.<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor;  ?>
                <li class="page-item<?= $next ?>">
                    <a class="page-link" href="?p=post.index.<?= $page + 1; ?>" aria-disabled="<?= !empty($next) ? 'true' : '' ?>">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-sm-4">
        <ul>
            <?php foreach ($categories as $category) : ?>
                <li><a href="<?= $category->url; ?>"><?= $category->title; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
