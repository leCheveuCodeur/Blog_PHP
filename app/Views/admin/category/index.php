<h1>Administrer les categories</h1>

<p><a href="?p=admin.category.add" class="btn btn-success">Ajouter</a></p>
<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Titre</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorys as $category) : ?>
            <tr>
                <td><?= $category->id; ?></td>
                <td><?= $category->title; ?></td>
                <td>
                    <a class="btn btn-primary" href="?p=admin.category.edit.<?= $category->id ?>">Editer</a>
                    <a class="btn btn-danger" href="?p=admin.category.delete.<?= $category->id ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item<?= $previous ?>">
            <a class="page-link" href="?p=admin.category.index.<?= $page - 1; ?>" aria-disabled="<?= !empty($previous) ? 'true' : '' ?>">&laquo;</a>
        </li>
        <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
            <li class="page-item <?= $i == $page ? ' active' : null; ?>" <?= $i == $page ? ' arria-current="page"' : null ?>>
                <a class="page-link" href="?p=admin.category.index.<?= $i; ?>"><?= $i; ?></a>
            </li>
        <?php endfor;  ?>
        <li class="page-item<?= $next ?>">
            <a class="page-link" href="?p=admin.category.index.<?= $page + 1; ?>" aria-disabled="<?= !empty($next) ? 'true' : '' ?>">&raquo;</a>
        </li>
    </ul>
</nav>
