<div class="container-xxl text-dark">
    <form class="user-log text mx-auto" method="post">
        <?= $form->input("usernameOrEmail", "Pseudo ou Email"); ?>
        <input type="text" name="pseudo" id="pseudo" class="picpirate">
        <?= $form->input("password", "Mot de passe", ["type" => "password"]); ?>
        <button class="btn btn-primary" type="submit">Connexion</button>
    </form>
    <a class="d-block text-center mt-5" href="?p=user.add&return=user.login">Créer un compte</a>
</div>
