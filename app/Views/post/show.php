<h1><?= $this->antiXss($post->title); ?></h1>
<p>Rédigé par <?= $this->antiXss($post->author); ?></p>
<p><em><?= $post->category; ?></em></p>
<h2><?= $this->antiXss($post->leadIn); ?></h2>
<p><?= $this->antiXss($post->content); ?></p>
<?php foreach ($comments as $comment) : ?>
    <p><?= $this->antiXss($comment->content); ?>
        par <?= $this->antiXss($comment->user); ?>
        le <?= date("d/m/Y à H:i:s", strtotime($comment->lastDate)); ?>
    </p>
<?php endforeach; ?>

<?php if (empty($_SESSION['auth'])) : ?>
    <a href="index.php?p=user.login&return=<?= \str_replace('index.php?p=', '', $post->url); ?>">Laisser un commentaire</a>
<?php endif; ?>

<?php if (isset($_SESSION['auth'])) : ?>
    <form action="index.php/?p=comment.add.<?= $post->id ?>" method="post">
        <h3>Vous voulez réagir ? N'hésitez pas les bros !</h3>
        <?= $form->input("content", "Commentaire", ["type" => "textarea"]); ?>
        <button class="btn btn-primary">Commenter !</button>
    </form>
<?php endif; ?>
