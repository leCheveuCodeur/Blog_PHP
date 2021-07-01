<div class="blog container-xxl p-0">

    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold"><?= $this->antiXss($post->title); ?></h1>
    </div>

    <div class="post-show">
        <div class="post-show_infos d-flex flex-wrap justify-content-evenly d-lg-block text-center text-break text-lg-end me-lg-5 mt-lg-5">
            <p class="text-secondary"><?= $this->formatDate($post->lastDate); ?></p>
            <p class="text-light">par <?= $this->antiXss($post->author); ?></p>
            <p><a class="nav-link p-0" href="?p=post.category.<?= $post->category_id; ?>">#<?= $post->category; ?></a></p>
        </div>

        <div class="post-show_post card p-4 p-md-5 text-dark shadow-sm">
            <p class="fs-4 fw-bold"><?= $this->antiXss($post->leadIn); ?></p>
            <p><?= $this->antiXss($post->content); ?></p>
        </div>

        <div class="post-show_comments">
            <div class="d-flex flex-wrap justify-content-center justify-content-xl-between align-items-center mx-auto w-50">
                <div class="comments_count text-secondary mx-auto"><?= count($comments); ?> Commentaire<?= count($comments) > 1 ? 's' : ''; ?></div>
                <?php if (empty($this->SESSION['auth'])) : ?>
                    <a class="comments_post nav-link text-light p-0 mx-auto text-center" href="index.php?p=user.login&return=<?= \str_replace('index.php?p=', '', $post->url); ?>">Poster un commentaire</a>
                <?php endif; ?>
            </div>

            <div>
                <?php foreach ($comments as $comment) : ?>
                    <div class="comment_card text-dark mx-auto mt-4 p-2 p-md-3">
                        <p class="m-0 text-secondary"><?= $this->antiXss($comment->user); ?>
                            | <?= date("d/m/Y -- H:i", strtotime($comment->lastDate)); ?></p>
                        <p class="m-0"><?= $this->antiXss($comment->content); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div>
                <?php if (isset($this->SESSION['auth'])) : ?>
                    <form class="post-show_addcomment mx-auto mt-5" method="post">
                        <p class="text-center">Laisser un commentaire</p>
                        <?= $form->input("content", "Commentaire", ["type" => "textarea", "maxlength" => "5000"]); ?>
                        <button class="btn btn-primary d-block mx-auto ">Soumettre !</button>
                    </form>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
