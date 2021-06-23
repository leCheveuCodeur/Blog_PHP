<div class="admin container-xxl">
    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Administrer les commentaires</h1>
    </div>
    <div>
        <table class="table table-dark table-hover">
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

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item<?= $previous ?>">
                    <a class="page-link" href="?p=admin.comment.index.<?= $page - 1; ?>" aria-disabled="<?= !empty($previous) ? 'true' : '' ?>">&laquo;</a>
                </li>
                <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                    <li class="page-item <?= $i == $page ? ' active' : null; ?>" <?= $i == $page ? ' arria-current="page"' : null ?>>
                        <a class="page-link" href="?p=admin.comment.index.<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor;  ?>
                <li class="page-item<?= $next ?>">
                    <a class="page-link" href="?p=admin.comment.index.<?= $page + 1; ?>" aria-disabled="<?= !empty($next) ? 'true' : '' ?>">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>

</div>
