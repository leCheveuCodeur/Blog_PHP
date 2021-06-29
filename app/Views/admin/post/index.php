<div class="admin container-xxl">
    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Administrer les articles</h1>
    </div>
    <div>
        <p><a href="?p=admin.post.add" class="btn btn-success">Ajouter</a></p>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dernière édition</th>
                    <th>Titre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td data-label="ID"><?= $post->id; ?></td>
                        <td data-label="Dernière édition"><?= 'le ' . date("d/m/Y", strtotime($post->lastDate)) . '<br> à ' . date("H:i:s", strtotime($post->lastDate)); ?></td>
                        <td data-label="Titre"><?= $this->antiXss(\substr($post->title, 0, 100)); ?>.<?= strlen($post->title) > 99 ? '...' : '' ?></td>
                        <td class="table-action">
                            <a class="btn btn-primary" href="?p=admin.post.edit.<?= $post->id ?>">Editer</a>
                            <a class="btn btn-danger" href="?p=admin.post.delete.<?= $post->id ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $paging; ?>

    </div>

</div>
