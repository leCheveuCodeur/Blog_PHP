<div class="admin container-xxl">
    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Administrer les articles</h1>
    </div>
    <div>
        <form class="admin-edit" method="post">
            <?= $form->input("title", "Titre de l'article"); ?>
            <?= $form->input("leadIn", "Châpo", ["type" => "textarea", "maxlength" => 355]); ?>
            <?= $form->input("content", "Contenu", ["type" => "textarea"]); ?>
            <?= $form->select("category_id", "Catégorie", $categories); ?>
            <button class="btn btn-primary">Sauvegarder</button>
        </form>
    </div>
