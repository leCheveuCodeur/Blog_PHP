<form method='post'>
    <?= $form->input('username', 'Pseudo'); ?>
    <?= $form->input('email', 'Adresse mail', ['type' => 'email']); ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?> <?= $form->input('password2', 'Confirmation du mot de passe', ['type' => 'password']); ?>
    <button class='btn btn-primary'>Envoyer</button>
</form>
