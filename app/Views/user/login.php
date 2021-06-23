<form method="post">
    <?= $form->input("usernameOrEmail", "Pseudo ou Email"); ?>
    <?= $form->input("password", "Mot de passe", ["type" => "password"]); ?>
    <button class="btn btn-primary" type="submit">Envoyer</button>
</form>
<a href="?p=user.add&return=user.login">Créer un compte</a>
