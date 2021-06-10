<h1>Administrer les commentaires</h1>

<table class="table">
    <thead>
        <tr>
            <td>Auteur</td>
            <td>Contenu</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comments as $comment) : ?>
            <tr>
                <td><?= $this->antiXss($comment->user); ?></td>
                <td><?= $this->antiXss($comment->content); ?></td>
                <td>
                    <a class="btn btn-primary" href="?p=admin.comment.edit.<?= $comment->id ?>">Approuver</a>
                    <a class="btn btn-danger" href="?p=admin.comment.delete.<?= $comment->id ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
