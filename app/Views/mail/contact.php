<div class="blog">

    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Me Contacter</h1>
    </div>
    <div class="contact">
        <form class="contact-form text-dark" method="post">
            <?= $form->input("name", "Nom / Prénom"); ?>
            <input type="text" name="surname" id="surname" class="picpirate">
            <?= $form->input("mail", "Email", ["type" => "email"]); ?>
            <?= $form->input("subject", "Sujet"); ?>
            <?= $form->input("content", "Message", ["type" => "textarea"]); ?>
            <button class="btn btn-primary w-50 mx-auto">Envoyer</button>
        </form>
    </div>
</div>
