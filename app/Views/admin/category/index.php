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
        <?php foreach ($items as $category) : ?>
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
