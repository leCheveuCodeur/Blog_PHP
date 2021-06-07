<h1><?= $post->title; ?></h1>
<p><em><?= $post->category; ?></em></p>
<p><?= $post->content; ?></p>
<?php foreach ($comments as $comment) : ?>
<<<<<<< HEAD
<<<<<<< Updated upstream
    <p><?= $comment->content; ?> par <?= $comment->user; ?> le <?= $comment->date; ?></p>
=======
    <p><?= $comment->content; ?> par <?= $comment->user; ?> le <?= $comment->lastDate; ?></p>
>>>>>>> feature/comment/#7
<?php endforeach; ?>

<form action="index.php/?p=comment.add&id=<?= $post->id ?>" method="post">
    <h3>Vous voulez réagir ? N'hésitez pas les bros !</h3>
    <?= $form->input("content", "Commentaire", ["type" => "textarea"]); ?>
    <button class="btn btn-primary">Commenter !</button>
</form>
=======
    <p><?= $comment->content; ?>
        par <?= $comment->user; ?>
        le <?= date("d/m/Y à H:i:s",strtotime($comment->lastDate)); ?>
    </p>
<?php endforeach; ?>

<?php if (empty($_SESSION['auth'])) : ?>
    <a href="index.php?p=user.login&return=<?= \str_replace('index.php?p=', '', $post->url); ?>">Laisser un commentaire</a>
<?php endif; ?>

<?php if (isset($_SESSION['auth'])) : ?>
    <form action="index.php/?p=comment.add&id=<?= $post->id ?>" method="post">
        <h3>Vous voulez réagir ? N'hésitez pas les bros !</h3>
        <?= $form->input("content", "Commentaire", ["type" => "textarea"]); ?>
        <button class="btn btn-primary">Commenter !</button>
    </form>
<?php endif; ?>
>>>>>>> Stashed changes
