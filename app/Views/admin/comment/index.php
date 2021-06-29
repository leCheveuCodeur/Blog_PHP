<div class="admin container-xxl">
    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Administrer les commentaires</h1>
    </div>
    <div>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Auteur</th>
                    <th>Contenu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment) : ?>
                    <tr>
                        <td data-label="Auteur"><?= $this->antiXss($comment->user); ?></td>
                        <td data-label="Contenu"><?= $this->antiXss($comment->content); ?></td>
                        <td class="table-action">
                            <a class="btn btn-primary" href="?p=admin.comment.edit.<?= $comment->id ?>">Approuver</a>
                            <a class="btn btn-danger" href="?p=admin.comment.delete.<?= $comment->id ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $paging; ?>

    </div>

</div>
