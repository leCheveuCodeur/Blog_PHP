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
                    <a class="btn btn-primary" href="?p=admin.category.edit&id=<?= $category->id ?>">Editer</a>
                    <form action="?p=admin.category.delete" method="POST" style="display: inline">
                        <input type="hidden" name="id" value="<?= $category->id ?>">
                        <button type="submit" class="btn btn-danger" href="?p=admin.category.delete&id=<?= $category->id ?>">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
