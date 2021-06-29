<div class="admin container-xxl">
    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Administrer les categories</h1>
    </div>
    <div>

        <p><a href="?p=admin.category.add" class="btn btn-success">Ajouter</a></p>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorys as $category) : ?>
                    <tr>
                        <td data-label="ID"><?= $category->id; ?></td>
                        <td data-label="Titre"><?= $category->title; ?></td>
                        <td class="table-action">
                            <a class="btn btn-primary" href="?p=admin.category.edit.<?= $category->id ?>">Editer</a>
                            <a class="btn btn-danger" href="?p=admin.category.delete.<?= $category->id ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?= $paging; ?>

    </div>
</div>
