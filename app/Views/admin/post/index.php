<div class="admin container-xxl">
    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Administrer les articles</h1>
    </div>
    <div>
        <p><a href="?p=admin.post.add" class="btn btn-success">Ajouter</a></p>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Dernière édition</td>
                    <td>Titre</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?= $post->id; ?></td>
                        <td><?= 'le ' . date("d/m/Y", strtotime($post->lastDate)) . '<br> à ' . date("H:i:s", strtotime($post->lastDate)); ?></td>
                        <td><?= $this->antiXss($post->title); ?></td>
                        <td>
                            <a class="btn btn-primary" href="?p=admin.post.edit.<?= $post->id ?>">Editer</a>
                            <a class="btn btn-danger" href="?p=admin.post.delete.<?= $post->id ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item<?= $previous ?>">
                    <a class="page-link" href="?p=admin.post.index.<?= $page - 1; ?>" aria-disabled="<?= !empty($previous) ? 'true' : '' ?>">&laquo;</a>
                </li>
                <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                    <li class="page-item <?= $i == $page ? ' active' : null; ?>" <?= $i == $page ? ' arria-current="page"' : null ?>>
                        <a class="page-link" href="?p=admin.post.index.<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor;  ?>
                <li class="page-item<?= $next ?>">
                    <a class="page-link" href="?p=admin.post.index.<?= $page + 1; ?>" aria-disabled="<?= !empty($next) ? 'true' : '' ?>">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>

</div>
