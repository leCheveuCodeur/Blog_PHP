<form method="post">
    <?= $form->input("name", "Nom / Prénom"); ?>
    <?= $form->input("mail", "Email", ["type" => "email"]); ?>
    <?= $form->input("subject", "Sujet"); ?>
    <?= $form->input("content", "Message", ["type" => "textarea"]); ?>
    <button class="btn btn-primary">Envoyer</button>
</form>
