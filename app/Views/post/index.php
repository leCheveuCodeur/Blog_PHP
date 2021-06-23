<div class="blog container-xxl">

    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Le Blog</h1>

        <nav class="nav justify-content-center">
            <?php foreach ($categories as $category) : ?>
                <a class="nav-link" href="<?= $category->url; ?>"><?= $category->title; ?></a>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="posts">
        <?php foreach ($posts as $post) : ?>
            <div class="post bg-light text-dark rounded-2 px-3 py-2 shadow-sm">
                <div class="post-infos text-primary fw-bold d-flex justify-content-between">
                    <div><?= $post->category; ?></div>
                    <div class="post-infos-comments"><?= count($comments->findWithPost($post->id));  ?></div>
                </div>

                <h2 class="post-h2"><a class="text-dark" href="<?= $post->url; ?>"><?= $this->antiXss($post->title); ?></a></h2>

                <p class="text-secondary fw-bold"><?= $post->author; ?> / <?= $this->formatDate($post->lastDate); ?></p>

                <p><?= $post->extrait; ?></p>
            </div>

        <?php endforeach; ?>
    </div>
    <!-- Pagination -->
    <nav class="paging" aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item<?= $previous ?>">
                <a class="page-link" href="?p=post.index.<?= $page - 1; ?>" aria-disabled="<?= !empty($previous) ? 'true' : 'false' ?>">&laquo;</a>
            </li>
            <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                <li class="page-item <?= $i == $page ? ' active' : null; ?>" <?= $i == $page ? ' arria-current="page"' : null ?>>
                    <a class="page-link" href="?p=post.index.<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor;  ?>
            <li class="page-item<?= $next ?>">
                <a class="page-link" href="?p=post.index.<?= $page + 1; ?>" aria-disabled="<?= !empty($next) ? 'true' : 'false' ?>">&raquo;</a>
            </li>
        </ul>
    </nav>
</div>
