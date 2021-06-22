<div class="blog container-xxl">

    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Me Contacter</h1>
    </div>
    <div>
        <form class="contact text-dark" method="post">
            <?= $form->input("name", "Nom / Prénom"); ?>
            <?= $form->input("mail", "Email", ["type" => "email"]); ?>
            <?= $form->input("subject", "Sujet"); ?>
            <?= $form->input("content", "Message", ["type" => "textarea"]); ?>
            <button class="btn btn-primary w-50 mx-auto">Envoyer</button>
        </form>
    </div>
</div>
