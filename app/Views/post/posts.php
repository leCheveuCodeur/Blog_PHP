<div class="posts">
    <?php foreach ($posts as $post) : ?>
        <div class="post bg-light text-dark rounded-2 px-3 py-2">
            <div class="post-infos text-primary fw-bold d-flex justify-content-between">
                <div><?= $post->category; ?></div>
                <div class="post-infos-comments"><?= count($comments->findWithPost($post->id));  ?></div>
            </div>

            <h2 class="post-h2"><a class="text-dark" href="<?= $post->url; ?>"><?= $this->antiXss(\substr($post->title, 0, 80)); ?>.<?= strlen($post->title) > 80 ? '...' : '' ?></a></h2>

            <p class="text-secondary fw-bold"><?= $post->author; ?> / <?= $this->formatDate($post->lastDate); ?></p>

            <p class="post-extrait"><?= $post->extrait; ?></p>
        </div>

    <?php endforeach; ?>
</div>
