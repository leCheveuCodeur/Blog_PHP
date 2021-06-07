<h1>Administrer les articles</h1>

<p><a href="?p=admin.post.add" class="btn btn-success">Ajouter</a></p>
<table class="table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Titre</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <td><?= $post->id; ?></td>
                <td><?= $post->title; ?></td>
                <td>
                    <a class="btn btn-primary" href="?p=admin.post.edit.<?= $post->id ?>">Editer</a>
                    <a class="btn btn-danger" href="?p=admin.post.delete.<?= $post->id ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
