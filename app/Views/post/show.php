<h1><?= $post->title; ?></h1>
<p><em><?= $post->category; ?></em></p>
<p><?= $post->content; ?></p>
<?php foreach ($comments as $comment) : ?>
    <p><?= $comment->content; ?> par <?= $comment->user; ?> le <?= $comment->date; ?></p>
<?php endforeach; ?>

<form method="post">
    <h3>Vous voulez réagir ? N'hésitez pas les bros !</h3>
    <?= $form->input("content", "Commentaire", ["type" => "textarea"]); ?>
    <button class="btn btn-primary">Commenter !</button>
</form>
