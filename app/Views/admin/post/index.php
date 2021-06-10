<h1>Administrer les articles</h1>

<p><a href="?p=admin.post.add" class="btn btn-success">Ajouter</a></p>
<table class="table">
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
                <td><?= 'le '.date("d/m/Y", strtotime($post->lastDate)).'<br> à '.date("H:i:s", strtotime($post->lastDate)); ?></td>
                <td><?= $this->antiXss($post->title); ?></td>
                <td>
                    <a class="btn btn-primary" href="?p=admin.post.edit.<?= $post->id ?>">Editer</a>
                    <a class="btn btn-danger" href="?p=admin.post.delete.<?= $post->id ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
