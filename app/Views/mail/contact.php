<div class="blog">

    <div class="hero_blog">
        <h1 class="hero_blog-title text-center fw-bold">Me Contacter</h1>
    </div>
    <div class="contact">
        <form class="contact-form text-dark" method="post">
            <label for="surname" aria-hidden="true">Human only</label>
            <input type="text" name="surname" id="surname" class="picpirate">
            <?= $form->input("name", "Nom / Prénom"); ?>
            <?= $form->input("mail", "Email", ["type" => "email"]); ?>
            <?= $form->input("subject", "Sujet"); ?>
            <?= $form->input("content", "Message", ["type" => "textarea"]); ?>
            <button class="btn btn-primary w-50 mx-auto">Envoyer</button>
        </form>
    </div>
</div>
