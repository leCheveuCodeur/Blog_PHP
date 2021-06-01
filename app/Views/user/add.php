<form method='post'>
    <?= $form->input('firstName', 'Prénom'); ?>
    <?= $form->input('lastName', 'Nom'); ?>
    <?= $form->input('username', 'Pseudo'); ?>
    <?= $form->input('email', 'Adresse mail', ['type' => 'email']); ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <button class='btn btn-primary'>Envoyer</button>
</form>
